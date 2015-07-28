<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Input;

use App\Category;

class Blog extends Content
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
        return $this->blogs()->orderBy('id')->limit($limit)->get();
    }
}
