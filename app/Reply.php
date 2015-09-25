<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends D4lModel
{
    /**
     * The type
     *
     * @var int
     */
    const TYPE_CONTENT = 1;

    /**
     * The type
     *
     * @var int
     */
    const TYPE_COMMENT = 2;

    /**
     * The related User model
     *
     * @return \App\User
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * The related Content or Comment model
     */
    public function entity()
    {
        if ($this->type_id == Reply::TYPE_CONTENT) {
            return $this->belongsTo('App\Content', 'entity_id');
        } else if ($this->type_id == Reply::TYPE_COMMENT) {
            return $this->belongsTo('App\Comment', 'entity_id');
        }
    }

}
