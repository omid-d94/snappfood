<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Comments\CommentRequest;
use App\Http\Requests\User\Comments\GetCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Order;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    /**
     * make a comment on user's order by user
     *
     * @param CommentRequest $request
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     * @throws Exception
     */
    public function makeComment(CommentRequest $request)
    {
        try {

            $order = Order::where("id", $request->input("order_id"))->withTrashed()->first();
            if ($order->status == "DELIVERED") {
                $validated = $request->validated();
                $request->authorize();
                $result = Comment::create($validated);
                if (!is_null($result)) {
                    return response(["message" => "your comment has been registered"],
                        Response::HTTP_CREATED);
                }
            }
            return response(["message" => "Currently, it is not possible to register a comment"],
                Response::HTTP_NOT_ACCEPTABLE);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Get comments group by Restaurant or food
     *
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function getFoodComments(GetCommentRequest $request)
    {
        $comments = Comment::whereHas("order",
            function ($query) use ($request) {
                return $this->getOrder($request, $query);
            })->with("order", function ($query) use ($request) {
            return $this->getOrder($request, $query);
        })->get();
        return empty($comments)
            ? response(["message" => "There is no comments"], Response::HTTP_NOT_FOUND)
            : response(CommentResource::collection($comments), Response::HTTP_OK);
    }

    /**
     * Get order related to the comment
     *
     * @param GetCommentRequest $request
     * @param $query
     * @return mixed
     */
    public function getOrder(GetCommentRequest $request, $query)
    {
        return $query->withTrashed()
            ->where("restaurant_id", $request->restaurant_id)
            ->with("foods", function ($query) use ($request) {
                return $this->getFoods($request, $query);
            })->whereHas("foods",
                function ($query) use ($request) {
                    return $this->getFoods($request, $query);
                });
    }

    /**
     * Get foods related to the order
     *
     * @param GetCommentRequest $request
     * @param $query
     * @return mixed
     */
    public function getFoods(GetCommentRequest $request, $query)
    {
        return $query->orWhere("food_id", $request->food_id);
    }
}
