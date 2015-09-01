<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends D4lModel implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    use EntrustUserTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'phone'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The related all Notices
     */
    public function allNotices()
    {
         return $this->hasMany('App\Notice', 'user_id')->orderBy('created_at', 'desc');
    }

    /**
     * The related unread Notices
     */
    public function uncheckNotices()
    {
         return $this->hasMany('App\Notice', 'user_id')->where(['is_checked' => false])->orderBy('created_at', 'desc');
    }

    /**
     * The related checked Notices
     */
    public function checkedNotices()
    {
         return $this->hasMany('App\Notice', 'user_id')->where(['is_checked' => true])->orderBy('created_at', 'desc');
    }
}
