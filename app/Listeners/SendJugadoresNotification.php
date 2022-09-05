<?php

namespace App\Listeners;

use App\Events\JugadoresEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendJugadoresNotification
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
     * @param  \App\Events\JugadoresEvent  $event
     * @return void
     */
    public function handle(JugadoresEvent $event)
    {
        //
    }
}
