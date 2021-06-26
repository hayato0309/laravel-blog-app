<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function edit()
    {
        $auth = Auth::user();
        return view('users.edit')->with('auth', $auth);
    }

    public function update($id){
        
        $input = request()->validate([
            'name' => ['required', 'string', 'max:225', 'alpha_dash'],
            'email' => ['required', 'email', 'max:225']
        ]);

        $user = User::findOrFail($id);
        $user->update($input);

        session()->flash('user-profile-updated-message', 'Your profile was updated successfully.');

        return back();
    }
}
