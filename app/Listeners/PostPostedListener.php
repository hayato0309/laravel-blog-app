<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\PostPostedEvent;
use App\Notifications\PostPostedNotification;
use Illuminate\Support\Facades\Notification;
use App\User;
use Illuminate\Support\Facades\Auth;

class PostPostedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PostPostedEvent $event)
    {
        $post = $event->post;

        $followers = auth()->user()->followers()->get();

        Notification::send($followers, new PostPostedNotification($post));
    }
}
