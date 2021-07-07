<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;
use Illuminate\Support\Facades\Hash;

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
            'email' => ['required', 'email', 'max:225'],
        ]);

        $user = User::findOrFail($id);

        if (request('avatar')) {
            $input['avatar'] = $request->file('avatar')->store('images');
        }

        $user->update($input);

        $request->session()->flash('user-profile-updated-message', 'Your profile was updated successfully.');

        return back();
    }

    public function editPassword()
    {
        $auth = Auth::user();
        return view('users.edit_password')->with('auth', $auth);
    }

    public function updatePassword(Request $request)
    {
        $auth = Auth::user();

        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $validator->validate();

        // Check if the input password and current password match
        if (!(Hash::check($request->current_password, $auth->password))) {
            $validator->errors()->add('current_password', "This password deosn't macth the current password.");
            return back()->withInput()->withErrors($validator);
        }

        $auth->password = bcrypt($request->new_password);
        $auth->save();

        $request->session()->flash('updated-password', 'The password was updated successfully.');

        return redirect()->route('user.edit', $auth->id);
    }
}
