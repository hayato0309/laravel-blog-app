<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function showUsers()
    {
        $users = User::withTrashed()->orderBy('name', 'asc')->simplePaginate(20);

        foreach ($users as $user) {
            $user->roles = $user->getRoles($user);
        }

        return view('admin.users.index', compact('users'));
    }

    public function showPosts()
    {
        $posts = Post::orderBy('created_at', 'desc')->simplePaginate(20);

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
}
