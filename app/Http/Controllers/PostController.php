<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;
use App\Comment;
use App\Like;

class PostController extends Controller
{
    public function show($id)
    {
        $post = Post::findOrFail($id);

        $comments = Comment::where('post_id', $id)->orderBy('created_at', 'desc')->get();

        $likesCount = $post->loadCount('likes')->likes_count;

        // Checking if the post is already liked by the Auth user or not.
        $like = new Like();
        $user_id = Auth::user()->id;
        $post_id = $id;
        if ($like->likeExists($user_id, $post_id)) {
            $isLiked = true;
        } else {
            $isLiked = false;
        }

        return view('posts.show', compact('post', 'comments', 'likesCount', 'isLiked'));
    }

    public function list()
    {
        $posts = Post::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->simplePaginate(10);
        return view('posts.list', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $input = request()->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required', 'max:2000'],
            'post_image' => ['file', 'image', 'max:1024'],
        ]);

        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->title = $input['title'];
        $post->content = $input['content'];

        if (request('post_image')) {
            $post['post_image'] = request('post_image')->store('images');
        }

        $post->save();

        session()->flash('post-created-message', 'Post was created :' . $post['title']);

        return redirect()->route('home');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $input = request()->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required', 'max:2000'],
            'post_image' => ['file', 'image', 'max:1024'],
        ]);

        $post = Post::findOrFail($id);

        if (request('post_image')) {
            $input['post_image'] = $request->file('post_image')->store('images');
        }

        $post->update($input);

        session()->flash('post-updated-message', 'The post was updated successfully.');

        return back();
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        session()->flash('post-deleted-message', 'Post was deleted successfully.: ' . $post->title);

        return back();
    }

    public function like($id)
    {
        $user_id = Auth::user()->id;
        $post_id = $id;

        $like = new Like();

        if ($like->likeExists($user_id, $post_id)) {
            // Already liked => Remove Like
            $like = Like::where('user_id', '=', $user_id)->where('post_id', '=', $post_id)->delete();
        } else {
            // Not yet like => Add Like
            $like->user_id = Auth::user()->id;
            $like->post_id = $id;
            $like->save();
        }

        return back();
    }
}
