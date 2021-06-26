<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit()
    {
        $auth = Auth::user();
        return view('users.edit')->with('auth', $auth);
    }
}
