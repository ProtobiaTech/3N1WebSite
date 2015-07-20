<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * @var array Mass assignment
     */
    protected $fillable = ['name', 'parent_id', 'description', 'type_id'];

    /**
     * Topic of type_id column
     *
     * @var int
     */
    const TYPE_TOPIC = 1;

    /**
     * The related child Category models
     *
     * @return array|null
     */
    public function childCategorys()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }

    /**
     * catch all category
     *
     * @return
     */
    public function getTopic4TopCategorys()
    {
        return $this->whereRaw('parent_id = 0 and type_id = ' . Category::TYPE_TOPIC)->get();
    }
}
