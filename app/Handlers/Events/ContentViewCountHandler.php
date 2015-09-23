<?php

namespace App\Handlers\Events;

use App\Events\ContentWasShow;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContentViewCountHandler
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
     * @param  ContentWasShow  $event
     * @return void
     */
    public function handle(ContentWasShow $event)
    {
        $event->Content->timestamps = false;
        $event->Content->increment('view_count');
        $event->Content->save();
    }
}
