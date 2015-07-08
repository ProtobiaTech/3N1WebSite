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
     * Topic of type_id collumn
     *
     * @var int
     */
    const TYPE_TOPIC = 1;

    /**
     * the Model rules
     */
    public $rules = [
        'user_id'   =>  ['required', 'integer'],
        'type_id'   =>  ['required', 'integer'],
        'entity_id' =>  ['required', 'integer'],
        'body'      =>  ['required', 'min:6'],
    ];

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