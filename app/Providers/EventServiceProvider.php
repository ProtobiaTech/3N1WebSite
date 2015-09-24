<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\ContentWasCommented' => [
            'App\Handlers\Events\MakeNoticeHandler',
            'App\Handlers\Events\ContentCommentCountIncrementHandler',
        ],
        'App\Events\ContentWasReplied' => [
            'App\Handlers\Events\MakeNoticeHandler',
        ],
        'App\Events\CommentWasReplied' => [
            'App\Handlers\Events\MakeNoticeHandler',
        ],
        'App\Events\ContentWasVote' => [
            'App\Handlers\Events\ChangeContentVoteHandler',
        ],
        'App\Events\ContentWasShow' => [
            'App\Handlers\Events\ContentViewCountHandler',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
