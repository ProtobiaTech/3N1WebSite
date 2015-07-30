<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Exception\HttpResponseException;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

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

}
