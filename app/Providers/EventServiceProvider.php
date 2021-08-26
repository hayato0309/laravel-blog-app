<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\UserRegisteredEvent;
use App\Listeners\UserRegisteredListener;
use App\Events\PostPostedEvent;
use App\Listeners\PostPostedListener;
use App\Events\UserFollowedEvent;
use App\Listeners\UserFollowedListener;
use App\Events\EnsembleCreatedEvent;
use App\Listeners\EnsembleCreatedListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserRegisteredEvent::class => [
            UserRegisteredListener::class,
        ],
        PostPostedEvent::class => [
            PostPostedListener::class,
        ],
        UserFollowedEvent::class => [
            UserFollowedListener::class,
        ],

        EnsembleCreatedEvent::class => [
            EnsembleCreatedListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
