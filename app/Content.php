<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment, App\Category;

abstract class Content extends D4lModel
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
     * Query Topics
     */
    public function scopeTopics($query)
    {
        return $query->where('type_id', '=', Category::TYPE_TOPIC);
    }

    /**
     * Query Article
     */
    public function scopeArticles($query)
    {
        return $query->where('type_id', '=', Category::TYPE_ARTICLE);
    }

    /**
     * Query Blog
     */
    public function scopeBlogs($query)
    {
        return $query->where('type_id', '=', Category::TYPE_BLOG);
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

    /**
     * Get hot content
     */
    abstract public function getHotContents();

    /**
     * Get last comment User model
     *
     * @return \App\User
     */
    public function getLastCommentUser()
    {
        return Comment::where('entity_id', '=', $this->id)->orderBy('created_at', 'desc')->first();
    }

    /**
     * Content entity, add 1 number of comments
     */
    public function commentCountAddOne()
    {
        $this->comment_count = $this->comment_count + 1;
        if ($this->save()) {
            return true;
        } else {
            return false;
        }
    }
}
