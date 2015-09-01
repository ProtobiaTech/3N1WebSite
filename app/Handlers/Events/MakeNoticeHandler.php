<?php

namespace App\Handlers\Events;

use App\Events\ContentWasCommented;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Notice;

class MakeNoticeHandler
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
        $Notice = new Notice;
        $Notice->user_id        =       $event->Entity->user_id;
        $Notice->offer_user_id  =       $event->Comment->user_id;
        $Notice->type_id        =       $event->Comment->type_id;
        $Notice->entity_id      =       $event->Comment->entity_id;
        $Notice->save();

        $event->Entity->increment('comment_count');
        $event->Entity->last_comment_user_id = $event->Comment->user_id;
        $event->Entity->save();
    }
}
