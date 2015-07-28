<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Input;

use App\Category;

class Article extends Content
{
    /**
     * Get hot content
     *
     * @param int $Limit Per page limit
     *
     * @return null | array
     */
    public function getHotContents($limit = 10)
    {
        return $this->articles()->orderBy('id')->limit($limit)->get();
    }
}
