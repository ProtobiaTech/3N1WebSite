<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
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

}
