<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Input;

use App\Category;

class Topic extends Content
{
    /**
     * Get Topic models Pager
     *
     * @param int $limit Per page limit
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public static function getTopic($limit = 15)
    {
        $Topic = new Topic;
        $Topic->builder = $Topic->query();
        $Topic->selectCategory();
        $Topic->applyFilter();
        return $Topic->builder->paginate($limit);
    }

    /**
     * Query
     */
    public function scopeSelectContents($query)
    {
        return $this->builder = $query->where('type_id', '=', Category::TYPE_TOPIC);
    }

    /**
     *
     */
    public function applyFilter()
    {
        if (Input::has('filter')) {
            switch (Input::get('filter')) {
                case 'recent':
                    return $this->recent();
                    break;
                case 'excellent':
                    return $this->excellent();
                    break;
                case 'vote':
                    return $this->vote();
                    break;
                case 'noreply':
                    return $this->noreply();
                    break;
                default:
                    return $this->builder = $this->builder->orderBy('updated_at', 'desc')->orderBy('id', 'desc');
                    break;
            }
        } else {
            return $this->builder = $this->builder->orderBy('updated_at', 'desc')->orderBy('id', 'desc');
        }
    }

    /**
     *
     */
    public function scopeSelectCategory()
    {
        if (Input::has('category_id')) {
            $categoryId = Category::findOrFail(Input::get('category_id'))->childCategorys->modelKeys();
            return $this->builder = $this->builder->where('category_id', '=', Input::get('category_id'))->orWhereIn('category_id', $categoryId);
        } else {
            return $this->builder->where('type_id', Content::TYPE_TOPIC);
        }
    }

    /**
     *
     */
    public function scopeRecent($filter)
    {
        return $this->builder = $this->builder->orderBy('created_at', 'desc')->orderBy('id', 'desc');
    }

    /**
     *
     */
    public function scopeExcellent($filter)
    {
        return $this->builder = $this->builder->where('is_excellent', '=', true)
            ->orderBy('comment_count', 'desc')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc');
    }

    /**
     *
     */
    public function scopeVote($filter)
    {
        return $this->builder = $this->builder->orderBy('vote_up_count', 'desc')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc');
    }

    /**
     *
     */
    public function scopeNoReply($filter)
    {
        return $this->builder = $this->builder->orderBy('comment_count', 'asc')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc');
    }

}
