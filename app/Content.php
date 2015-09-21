<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment, App\Category;

class Content extends D4lModel
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
     * Query
     */
    public function scopeSelectContents($query)
    {
        return $query;
    }

    /**
     * Get hot content
     */
    public function getHotContents($paginate = 10, $where = null)
    {
        $builder = $this->selectContents()
            ->orderBy('comment_count', 'desc')->orderBy('view_count', 'desc')
            ->orderBy('id', 'desc');

        if (!empty($where)) {
            $builder = $builder->where($where);
        }
        return $builder->paginate($paginate);
    }

    /**
     * Get content
     */
    public function getData($paginate = 10, $where = null)
    {
        $builder = $this->selectContents()
            ->orderBy('id', 'desc');

        if (!empty($where)) {
            $builder = $builder->where($where);
        }
        return $builder->paginate($paginate);
    }

    /**
     * Get last comment User model
     *
     * @return \App\User
     */
    public function getLastCommentUser()
    {
        return Comment::where('entity_id', '=', $this->id)->orderBy('id', 'desc')->first();
    }
}
