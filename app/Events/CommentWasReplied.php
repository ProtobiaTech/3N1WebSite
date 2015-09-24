<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Reply, App\Notice;

class CommentWasReplied extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Reply $Entity)
    {
        $this->Entity = $Entity;
        $this->userId = $Entity->entity->user_id;
        $this->typeId = Notice::TYPE_REPLY_COMMENT;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
