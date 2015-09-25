<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends D4lModel
{
    /**
     * @var array Mass assignment
     */
    protected $fillable = ['name', 'weight', 'parent_id', 'description', 'type_id'];

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
     * The related child Category models
     *
     * @return array|null
     */
    public function childCategorys()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }

    public function contents()
    {
        return $this->hasMany('App\Content', 'category_id');
    }

    /**
     * Get top topic category
     *
     * @return
     */
    public function getTopic4TopCategorys($limit = null)
    {
        $builder = $this->whereRaw('parent_id = 0 and type_id = ' . Category::TYPE_TOPIC);
        $builder = $builder->orderBy('weight', 'asc');
        if (!empty($limit)) {
            $builder = $builder->limit($limit);
        }
        return $builder->get();
    }

    /**
     * get top blog category
     *
     * @return
     */
    public function getBlog4TopCategorys($limit = null)
    {
        $builder = $this->whereRaw('parent_id = 0 and type_id = ' . Category::TYPE_BLOG);
        $builder = $builder->orderBy('weight', 'asc');
        if (!empty($limit)) {
            $builder =  $builder->limit($limit);
        }
        return $builder->get();
    }

    /**
     * get top article category
     *
     * @return
     */
    public function getArticle4TopCategorys($limit = null)
    {
        $builder = $this->whereRaw('parent_id = 0 and type_id = ' . Category::TYPE_ARTICLE);
        $builder = $builder->orderBy('weight', 'asc');
        if (!empty($limit)) {
            $builder = $builder->limit($limit);
        }
        return $builder->get();
    }

    /**
     *
     */
    public function getHotContents($limit = 10)
    {
        $where['category_id'] = $this->id;
        return (new Content)->getHotContents($limit, $where);
    }
}
