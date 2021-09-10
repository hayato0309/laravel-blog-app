<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;
use App\Post;
use App\Like;
use App\Follow;
use App\Events\UserFollowedEvent;



class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);

        $posts = Post::where('user_id', '=', $user->id)->orderBy('created_at', 'desc')->paginate(5);

        // AuthユーザがそのポストをLikeしているか確認し、$post['isLiked']にブール値を格納
        foreach ($posts as $post) {
            Post::likeExists($post, $user);
        }

        // Checking if Auth user is already following the user
        $follow = new Follow();
        $following_id = Auth::user()->id;
        $followed_id = $id;
        if ($follow->followingExists($following_id, $followed_id)) {
            $isFollowing = true;
        } else {
            $isFollowing = false;
        }

        // 表示しているProfileページのユーザに紐づく全ての"following"ユーザを取得（Authをフォローしている）
        $followings = $user->followings()->get();

        // それらのユーザをAuthもフォローしているかどうかの確認
        foreach ($followings as $following) {
            $following['auth_is_following'] = $follow->followingExists($following_id, $following['id']);
        }

        // 表示しているProfileページのユーザに紐づく全ての"followed"ユーザを取得（Authにフォローされている/Authがフォローしている）
        $followers = $user->followers()->get();

        // それらのユーザをAuthもフォローしているかどうかの確認
        foreach ($followers as $follower) {
            $follower['auth_is_following'] = $follow->followingExists($following_id, $follower['id']);
        }

        return view('users.show', compact('user', 'posts', 'isFollowing', 'followings', 'followers'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {

        $input = request()->validate([
            'name' => ['required', 'string', 'max:30', 'alpha_dash'],
            'avatar' => ['file', 'image', 'max:1024'],
            'email' => ['required', 'email', 'max:50'],
            'greeting' => ['max:130'],
            'interests' => ['max:170'],
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
        $user = Auth::user();
        return view('users.edit_password', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $validator->validate();

        // Check if the input password and current password match
        if (!(Hash::check($request->current_password, $user->password))) {
            $validator->errors()->add('current_password', "This password deosn't macth the current password.");
            return back()->withInput()->withErrors($validator);
        }

        $user->password = bcrypt($request->new_password);
        $user->save();

        $request->session()->flash('updated-password', 'The password was updated successfully.');

        return view('users.edit', compact('user'));
    }

    public function follow($id)
    {
        $following_id = Auth::user()->id;
        $followed_id = $id;

        $follow = new Follow();

        if ($follow->followingExists($following_id, $followed_id)) {
            // Already following => Remove following
            $follow = Follow::where('following_id', '=', $following_id)->where('followed_id', '=', $followed_id)->delete();
        } else {
            // No following yet => Record new following
            $follow->following_id = $following_id;
            $follow->followed_id = $followed_id;

            event(new UserFollowedEvent(User::find($followed_id)));

            $follow->save();
        }

        return back();
    }
}
