<?php

namespace Model;

class Profile extends Model
{
    protected $table = 'profile';
	protected $connection = 'user';
    public $timestamps = false;

	public function getFullNameAttribute()
	{
		return trim($this->first_name . ' ' . $this->last_name);
	}

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}