<?php

namespace App;

use Validator;

class Comment extends D4lModel
{
    /**
     * The table name
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * Date transform
     */
    public function getDates()
    {
        return ['created_at', 'updated_at'];
    }

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
     * The related Content model
     */
    public function entity()
    {
         return $this->belongsTo('App\Content', 'entity_id');
    }

    /**
     * The related reply model
     *
     * @return array|null
     */
    public function replys()
    {
        return $this->hasMany('App\Reply', 'entity_id')
            ->where('type_id', Reply::TYPE_COMMENT)
            ->orderBy('id', 'desc');
    }

}
