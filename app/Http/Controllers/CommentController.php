<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use Illuminate\Support\Str;
use App\Post;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'comment' => ['required', 'max: 2000'],
        ]);

        $comment = new Comment;

        $comment->comment = $validated['comment'];
        $comment->user()->associate($request->user());

        $post = Post::find($id);
        $post->comments()->save($comment);

        session()->flash('comment-posted-message', 'Your comment was posted successfully.');

        return back();
    }

    public function replyStore(Request $request, $post_id, $comment_id)
    {
        $validated = $request->validate([
            'comment' => ['required', 'max: 2000'],
        ]);

        $reply = new Comment();

        $reply->comment = $validated['comment'];
        $reply->user()->associate($request->user());

        $reply->parent_id = $comment_id;
        $post = Post::find($post_id);

        $post->comments()->save($reply);

        session()->flash('comment-posted-message', 'Your comment was posted successfully.');

        return back();
    }


    public function update($id)
    {
        $input = request()->validate([
            'updated_comment' => ['required', 'max:2000'],
        ]);

        $comment = Comment::findOrFail($id);

        $comment->comment = $input['updated_comment'];

        $comment->update();

        session()->flash('comment-updated-message', 'Your comment was updated successfully.');

        return back();
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        session()->flash('comment-deleted-message', 'Comment was deleted successfully.: ' . Str::limit($comment->content, 50, '...'));

        return back();
    }
}
