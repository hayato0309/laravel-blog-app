<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Role;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function showNotifications()
    {
        $notifications = DB::table('notifications')
            ->where('type', 'App\Notifications\UserRegisteredNotification')
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($notifications as $notification) {
            $notification->data = json_decode(($notification->data));
        }

        return view('admin.notifications.index', compact('notifications'));
    }

    public function showUsers()
    {
        $users = User::withTrashed()->orderBy('name', 'asc')->paginate(10);

        $roles = Role::all();

        $role = new Role();

        foreach ($users as $user) {
            // Getting role ID for iterated users
            $current_role_ids = array_column($role->getRoleIdsForUser($user)->toArray(), 'id');
            // Assigning the role ID array to iterated users
            $user->current_role_ids = $current_role_ids;
        }

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function updateRoles(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->roles()->sync($request['roles']);

        // $post->categories()->sync($input['categories']);
        return back();
    }

    public function showPosts()
    {
        $posts = Post::withTrashed()->orderBy('created_at', 'desc')->paginate(10);

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
