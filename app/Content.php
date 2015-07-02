<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    /**
     * The table name
     *
     * @var string
     */
    protected $table = 'contents';

    /**
     * Topic of type_id column
     *
     * @var int
     */
    const TYPE_TOPIC = 1;

    /**
     * Blog of type_id column
     *
     * @var int
     */
    const TYPE_BLOG = 2;

    /**
     * Article of type_id column
     *
     * @var int
     */
    const TYPE_ARTICLE = 3;

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
     * The related last comment User model
     *
     * @return \App\User
     */
    public function lastCommentUser()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * The related Category model
     *
     * @return \App\Category
     */
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    /**
     * The related Comment model
     *
     * @return array|null
     */
    public function comments()
    {
        return $this->hasMany('App\Comment', 'entity_id');
    }

}
