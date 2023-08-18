<?php

namespace App\Listeners\Asset\Room;

use App\Events\Asset\Room\EnableRoomEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EnableRoomListener
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
     * @param  \App\Events\Asset\Room\EnableRoomEvent  $event
     * @return void
     */
    public function handle(EnableRoomEvent $event)
    {
        //
    }
}