<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    // trạng thái tài khoản bị khóa
    const STATUS_LOCKED = 0;
    // trạng thái tài khoản hoạt động
    const STATUS_ACTIVE = 1;
    // xác nhận đăng nhập lần đầu tiên
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'level', 'status', 'point'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        if(Auth::user()->level == 1 || Auth::user()->level == 2 || Auth::user()->level == 3)
            return true;
    }

    public function isComposer()
    {
        if(Auth::user()->level > 0)
            return true;
    }

    public function stories()
    {
        return $this->hasMany('App\Models\Story');
    }
}
