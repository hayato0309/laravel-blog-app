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
        $users = User::orderBy('name', 'asc')->simplePaginate(20);

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
}
