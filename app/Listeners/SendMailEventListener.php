<?php

namespace App\Listeners;

use App\Events\SendMailEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendMailEventListener implements ShouldQueue
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
     * @param  SendMailEvent  $event
     * @return void
     */
    public function handle(SendMailEvent $event)
    {
        $event->handle();
    }
}
