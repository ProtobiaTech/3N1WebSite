<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    const TYPE_PROVINCE = 1;
    const TYPE_CITY = 2;
    const TYPE_COUNTY = 3;
}
