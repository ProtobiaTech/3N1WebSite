<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends D4lModel
{
    const TYPE_COMMENT_TOPIC    = 1;
    const TYPE_COMMENT_BLOG     = 2;
    const TYPE_COMMENT_ARTICLE  = 3;

    const TYPE_REPLY_CONTENT    = 4;
    const TYPE_REPLY_COMMENT    = 5;


    protected $guarded = ['id'];

    /**
     *
     */
    public function entity()
    {
        if ($this->type_id == Notice::TYPE_REPLY_CONTENT || $this->type_id == Notice::TYPE_REPLY_COMMENT) {
            return $this->belongsTo('App\Reply', 'entity_id');
        } else {
            return $this->belongsTo('App\Comment', 'entity_id');
        }
    }

    /**
     *
     */
    public function offerUser()
    {
        return $this->belongsTo('App\User', 'offer_user_id');
    }
}
