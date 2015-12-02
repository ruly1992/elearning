<?php

namespace Model;

class User extends \Cartalyst\Sentinel\Users\EloquentUser
{
    protected $connection = 'user';
    
    public function getFullNameAttribute()
    {
        return $this->profile->full_name;
    }

    public function getAvatarAttribute()
    {
        return $this->profile->avatar ? home_url('portal/assets/upload/avatar/' . $this->profile->avatar) : asset('../portal/assets/img/default_avatar_male.jpg');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}