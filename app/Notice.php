<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    /**
     *
     */
    public function notice()
    {
        return $this->belongsTo('App\Content', 'entity_id');
    }

    /**
     *
     */
    public function offerUser()
    {
        return $this->belongsTo('App\User', 'offer_user_id');
    }
}
