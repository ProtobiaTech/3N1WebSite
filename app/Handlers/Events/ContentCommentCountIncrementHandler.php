<?php

namespace App\Handlers\Events;

use App\Events\ContentWasCommented;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContentCommentCountIncrementHandler
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
     * @param  ContentWasCommented  $event
     * @return void
     */
    public function handle(ContentWasCommented $event)
    {
        $Content = $event->Entity->entity;
        $Content->increment('comment_count');
        $Content->last_comment_user_id = $event->Entity->user_id;
        $Content->save();
    }
}
