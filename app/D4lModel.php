<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Exception\HttpResponseException;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

use Schema;

abstract class D4lModel extends Model
{
    use SoftDeletes;

    /**
     * Get columnlisting
     */
    public function getColumnListing()
    {
        return Schema::getColumnListing($this->GetTable());
    }

    /**
     * The default order rule
     */
    public function scopeDefaultOrder($query)
    {
         return $query->orderByRaw('weight asc, created_at desc, id asc');
    }

    /**
     * Fill data
     */
    public function fillData($data)
    {
        $columns = $this->getColumnListing();
        $data = array_only($data, $columns);
        $this->fill($data);
    }

}
