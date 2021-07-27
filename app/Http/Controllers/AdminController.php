<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Role;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function showUsers()
    {
        $users = User::withTrashed()->orderBy('name', 'asc')->simplePaginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function showPosts()
    {
        $posts = Post::withTrashed()->orderBy('created_at', 'desc')->simplePaginate(20);

        return view('admin.posts.index', compact('posts'));
    }

    public function activateUser($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        session()->flash('user-activated-message', 'User was activated successfully. : ' . $user->name);

        return back();
    }

    public function deactivateUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('user-deactivated-message', 'User was deactivated successfully. : ' . $user->name);

        return back();
    }

    public function unhidePost($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();

        session()->flash('post-unhidden-message', 'User was unhidden successfully. : ' . $post->title);

        return back();
    }

    public function hidePost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        session()->flash('post-hidden-message', 'Post was hidden successfully. : ' . $post->title);

        return back();
    }
}
