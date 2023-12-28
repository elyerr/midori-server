<?php

namespace App\Listeners\Employee;

use App\Events\Employee\UpdateEmployeeEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateEmployeeListener
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
     * @param  \App\Events\Employee\UpdateEmployeeEvent  $event
     * @return void
     */
    public function handle(UpdateEmployeeEvent $event)
    {
        //
    }

    /**
     * Get the name of the listener's queue.
     */
    public function viaQueue(): string
    {
        return env('REDIS_QUEUE_EVENTS', 'events');
    }
}
