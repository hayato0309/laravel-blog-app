<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\EnsembleCreatedEvent;
use App\Notifications\EnsembleCreatedNotification;
use Illuminate\Support\Facades\Notification;

class EnsembleCreatedListener
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
    public function handle(EnsembleCreatedEvent $event)
    {
        $ensemble = $event->ensemble;

        $followers = auth()->user()->followers()->get();

        Notification::send($followers, new EnsembleCreatedNotification($ensemble));
    }
}
