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
     * The model rules
     *
     * @var array
     */
    public $rules = [];

    /**
     * The validator
     *
     * @var Validator|null
     */
    public $validator;

    /**
     * Model validate
     */
    public function validate()
    {
        $this->validator = Validator::make($this->getAttributes(), $this->rules);
        if ($this->validator->fails()) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Validated before saving
     */
    public function save(array $options = [])
    {
        // validate
        if (!$this->validate()) {
             return false;
        }

        return parent::save($options);
    }

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
