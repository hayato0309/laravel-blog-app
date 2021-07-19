<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function showUsers()
    {
        $users = User::simplePaginate(20);

        foreach ($users as $user) {
            $user->roles = $user->getRoles($user);
        }

        return view('admin.users.index', compact('users'));
    }
}
