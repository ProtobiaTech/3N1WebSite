<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends D4lModel
{
    /**
     * @var array Mass assignment
     */
    protected $fillable = ['site_name', 'site_slogan', 'site_keywords', 'site_description', 'site_ipc', 'site_analytic', 'contact_email'];

    /**
     *
     */
    public static function getSystemDatas()
    {
        return (new System)->find(1);
    }
}
