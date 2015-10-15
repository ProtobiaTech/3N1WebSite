<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
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

    const TYPE_TARGET_IFRAME = 1;

    const TYPE_TARGET_ORIGIN = 2;

    /**
     * Builder
     */
    public $builder;

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
     * The related reply model
     *
     * @return array|null
     */
    public function replys()
    {
        return $this->hasMany('App\Reply', 'entity_id')
            ->where('type_id', Reply::TYPE_CONTENT)
            ->orderBy('id', 'desc');
    }

    /**
     *
     */
    public function votes()
    {
        return $this->hasMany('App\ContentVote', 'entity_id');
    }

    /**
     *
     */
    public function myVote()
    {
        return ContentVote::where(['entity_id' => $this->id, 'user_id' => Auth::user()->id])->first();
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
            ->orderBy('created_at', 'desc')
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

    /**
     *
     */
    public function getType($id)
    {
        $Content = $this->findOrFail($id);
        switch ($Content->type_id) {
            case Content::TYPE_TOPIC:
                $ret = 'topic';
                break;
            case Content::TYPE_ARTICLE:
                $ret = 'article';
                break;
            case Content::TYPE_BLOG:
                $ret = 'blog';
                break;
        }
        return $ret;
    }

    /**
     * Get route
     */
    public function getAppointRoute($route, $id = null)
    {
        if ($id) {
            $ret = $this->getType($id);
        } else {
            $ret = $this->getType($this->id);
        }
        return $ret . '.' . $route;
    }
}
