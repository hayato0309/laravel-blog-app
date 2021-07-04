<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $post = request()->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required', 'max:2000'],
            'post_image' => ['file', 'image', 'max:1024'],
        ]);

        if (request('post_image')) {
            $post->post_image = $request->file('post_image')->store('images');
        }

        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->content = $request->content;

        $post->save();

        // return redirect()->route('user.edit', $auth->id);
    }
}
