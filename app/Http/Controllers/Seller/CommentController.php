<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Restaurant;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Seller\AnswerCommentRequest;

class CommentController extends Controller
{
    /**
     * Gets all comment
     * @return Application|Factory|View
     */
    public function index()
    {
        $comments = Comment::whereIn("order_id", $this->getOrders($this->getRestaurant()))
            ->orderBy("created_at","desc")
            ->paginate($perPage = 10, $columns = ["*"], $pageName = "comments");

        return view("comments.index", compact("comments"));
    }

    /**
     * Confirming comment by seller
     *
     * @param Comment $comment
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function confirmComment(Comment $comment)
    {
        try {

            $result = $comment->update(["is_confirmed" => Comment::CONFIRMED]);
            $this->ScoreUpdating();
            return $result
                ? redirect(status: Response::HTTP_OK)->route("seller.comments.index")
                    ->with(["success" => "The comment has been confirmed successfully"])
                : redirect()
                    ->back(status: Response::HTTP_INTERNAL_SERVER_ERROR);

        } catch (Exception $e) {
            throw new Exception(message: $e->getMessage());
        }
    }

    /**
     * Rejecting Comment by seller
     *
     * @param Comment $comment
     * @return RedirectResponse
     * @throws Exception
     */
    public function rejectComment(Comment $comment)
    {
        try {

            $result = $comment->update(["is_confirmed" => Comment::NOT_CONFIRMED]);

            return $result
                ? redirect(status: Response::HTTP_OK)->route("seller.comments.index")
                    ->with(["success" => "The comment has been rejected successfully"])
                : redirect()
                    ->back(status: Response::HTTP_INTERNAL_SERVER_ERROR);

        } catch (Exception $e) {
            throw new Exception(message: $e->getMessage());
        }
    }

    /**
     * Sending delete request to admin for the comment
     *
     * @param Comment $comment
     * @return RedirectResponse
     * @throws Exception
     */
    public function deleteRequest(Comment $comment)
    {
        try {
            $result = $comment->update(["is_confirmed" => Comment::DELETING]);

            return $result
                ? redirect(status: Response::HTTP_OK)->route("seller.comments.index")
                    ->with(["success" => "Delete request has been registered for this comment,
                                          \n it will be deleted after admin approval."])
                : redirect()
                    ->back(status: Response::HTTP_INTERNAL_SERVER_ERROR);

        } catch (Exception $e) {
            throw new Exception(message: $e->getMessage());
        }
    }

    /**
     * Displays the answer page
     * @param Comment $comment
     * @return Application|Factory|View
     * @throws Exception
     */
    public function ReplyingToComment(Comment $comment)
    {
        try {
            return view("comments.replying", compact("comment"));
        } catch (Exception $e) {
            throw new Exception(message: $e->getMessage());
        }
    }

    /**
     * Replying to comment by seller
     *
     * @param AnswerCommentRequest $request
     * @param Comment $comment
     * @return RedirectResponse
     * @throws Exception
     */
    public function SendingReply(AnswerCommentRequest $request, Comment $comment)
    {
        try {
            $validated = $request->validated();
            $result = $comment->update($validated);
            return $result
                ? redirect(status: Response::HTTP_OK)->route("seller.comments.index")
                    ->with(["success" => "Your answer has been registered successfully."])
                : redirect()
                    ->back(status: Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Exception $e) {
            throw new Exception(message: $e->getMessage());
        }

    }

    /**
     * Updating restaurant score after confirm a comment
     *
     * @return void
     */
    public function ScoreUpdating(): void
    {
        $comments = Comment::whereIn("order_id", $this->getOrders($this->getRestaurant()))
            ->where("is_confirmed", Comment::CONFIRMED)
            ->get(["score"]);
        $newScore = 0;
        foreach ($comments as $comment) {
            $newScore += $comment->score;
        }
        $newScore /= count($comments);
        $this->getRestaurant()->update(["score" => $newScore]);
    }

    /**
     * Get restaurant model related to seller
     *
     * @return Restaurant
     */
    public function getRestaurant(): Restaurant
    {
        return auth("seller")->user()->restaurants->first();
    }

    /**
     * Get orders related to restaurant
     *
     * @param Restaurant $restaurant
     * @return mixed
     */
    public function getOrders(Restaurant $restaurant): mixed
    {
        return Order::select("id")->where("restaurant_id", $restaurant->id)
            ->withTrashed()->get();
    }
}
