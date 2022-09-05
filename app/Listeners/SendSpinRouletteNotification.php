<?php

namespace App\Listeners;

use App\Events\SpinRouletteEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendSpinRouletteNotification
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
     * @param  \App\Events\SpinRouletteEvent  $event
     * @return void
     */
    public function handle(SpinRouletteEvent $event)
    {
        //
    }
}
