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
        \App\Blog::creating(function($content) {
            $content->province_id = 1364;
            $content->city_id = 1413;
            $content->county_id = 1415;
        });
        \App\Article::creating(function($content) {
            $content->province_id = 1364;
            $content->city_id = 1413;
            $content->county_id = 1415;
        });
        \App\Topic::creating(function($content) {
            $content->province_id = 1364;
            $content->city_id = 1413;
            $content->county_id = 1415;
        });
    }
}
