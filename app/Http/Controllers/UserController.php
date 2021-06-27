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

    public function update(Request $request, $id)
    {

        $input = request()->validate([
            'name' => ['required', 'string', 'max:225', 'alpha_dash'],
            'avatar' => ['file', 'image', 'max:1024'],
            'email' => ['required', 'email', 'max:225']
        ]);

        $user = User::findOrFail($id);

        if (request('avatar')) {
            $input['avatar'] = $request->file('avatar')->store('images');
        }

        $user->update($input);

        session()->flash('user-profile-updated-message', 'Your profile was updated successfully.');

        return back();
    }
}
