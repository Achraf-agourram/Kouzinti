<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function addComment (Request $request)
    {
        Comment::create([
            'commentContent' => $request->comment,
            'recipe_id' => $request->recipeToComment,
            'user_id' => Auth::id()
        ]);

        return redirect('/recipe/'.$request->recipeToComment);
    }

    public function editComment (Request $request)
    {
        $comment = Comment::findOrFail($request->commentToEdit);
        if (Auth::id() !== $comment->user_id) return redirect('/home');

        $comment->update([
            'commentContent' => $request->editedComment
        ]);

        return redirect('/recipe/'.$request->recipeToEdit);
    }

    public function deleteComment (Request $request)
    {
        $comment = Comment::findOrFail($request->commentToDelete);
        if (Auth::id() !== $comment->user_id) return redirect('/home');

        $comment->delete();

        return redirect('/recipe/'.$request->recipeToDelete);
    }
}
