<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    /**
     * Get all Requests for deleting comments
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $comments = Comment::where("is_confirmed", Comment::DELETING)
            ->whereHas("order", function ($query) {
                return $query->withTrashed();
            })->with("order", function ($query) {
                return $query->withTrashed();
            })->paginate($perPage = 10, $columns = ["*"], $pageName = "comments");

        return view("comments.admin.index", compact("comments"));
    }

    /**
     * soft deleting a comment
     *
     * @param Comment $comment
     * @return RedirectResponse
     */
    public function deletingConfirm(Comment $comment): RedirectResponse
    {
        $comment->delete();
        return redirect(status: Response::HTTP_NO_CONTENT)
            ->route("admin.comments.index")
            ->with(["success" => "Comment has been deleted successfully"]);
    }
}
