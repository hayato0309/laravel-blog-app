<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Role;
use App\Inquiry;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }


    // About notifications
    public function showNotifications()
    {
        $unread_notifications = auth()->user()->unreadNotifications
            ->where('type', 'App\Notifications\UserRegisteredNotification');

        $read_notifications = auth()->user()->notifications
            ->where('type', 'App\Notifications\UserRegisteredNotification')
            ->where('read_at', '<>', NULL);

        auth()->user()->unreadNotifications
            ->where('type', 'App\Notifications\UserRegisteredNotification')
            ->markAsRead();

        return view('admin.notifications.index', compact('unread_notifications', 'read_notifications'));
    }


    // About inquiries
    public function showInquiries(Request $request)
    {
        $inquiries = Inquiry::orderBy('created_at', 'desc')->paginate(10);

        // Inquiryのフィルタリング
        if ($request->inquiry_filter === 'solved') {
            // 解決したinquiryを取得
            $inquiries = Inquiry::where('is_solved', 1)->orderBy('created_at', 'desc')->paginate(10);
        } elseif ($request->inquiry_filter === 'unsolved') {
            // 未解決のinquiryを取得
            $inquiries = Inquiry::where('is_solved', 0)->orderBy('created_at', 'desc')->paginate(10);
        } else {
            // 全てのinquiryを取得（inquiry_filterがNULLの時。inquiryページ訪問時はこれ）
            $inquiries = Inquiry::orderBy('created_at', 'desc')->paginate(10);
        }

        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function solveInquiry($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->is_solved = 1;

        $inquiry->update();

        session()->flash('inquiry-status-solved-message', 'The status of the inquiry was changed to "solved" sccessfully. : ' . $inquiry->title);

        return back();
    }

    public function unsolveInquiry($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->is_solved = 0;

        $inquiry->update();

        session()->flash('inquiry-status-unsolved-message', 'The status of the inquiry was changed to "unsolved" sccessfully. : ' . $inquiry->title);

        return back();
    }


    // About users
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

        return back();
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


    // About posts
    public function showPosts()
    {
        $posts = Post::withTrashed()->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.posts.index', compact('posts'));
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
