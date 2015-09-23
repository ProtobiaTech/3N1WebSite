<?php

namespace App\Handlers\Events;

use App\Events\ContentWasVoteUp;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Content;

class ChangeContentVoteHandler
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
     * @param  ContentWasVoteUp  $event
     * @return void
     */
    public function handle($event)
    {
        $columnVoteUp = 'vote_up_count';
        $columnVoteDown = 'vote_down_count';
        $Content = $event->Content;
        $Content->timestamps = false;

        switch ($event->voteType) {
            case 'vote_up':
                $Content->increment($columnVoteUp);
                break;
            case 'vote_up_changed':
                $Content->increment($columnVoteUp);
                $Content->decrement($columnVoteDown);
                break;
            case 'vote_up_cancel':
                $Content->decrement($columnVoteUp);
                break;
            case 'vote_down':
                $Content->increment($columnVoteDown);
                break;
            case 'vote_down_changed':
                $Content->increment($columnVoteDown);
                $Content->decrement($columnVoteUp);
                break;
            case 'vote_down_cancel':
                $Content->decrement($columnVoteDown);
                break;
        }
    }
}
