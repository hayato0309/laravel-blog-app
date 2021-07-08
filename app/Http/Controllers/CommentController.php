<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $input = request()->validate([
            'content' => ['required', 'max:2000'],
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $id;
        $comment->content = $input['content'];

        $comment->save();

        session()->flash('comment-posted-message', 'Your comment was posted successfully.');

        return back();
    }
}
