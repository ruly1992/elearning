<?php

namespace Model\Forum;

use Model\User;

class Category extends Model
{
	protected $table = 'categories';

	public $timestamps = false;

	public function setNameAttribute($name)
	{
		$this->attributes['category_name'] = $name;
	}

	public function getNameAttribute()
	{
		return $this->category_name;
	}

	public function threads()
	{
		return $this->hasMany(Topic::class);
	}

	public function users()
	{
		$database = $this->getConnection()->getDatabaseName();

		return $this->belongsToMany(User::class, $database.'.category_user');
	}
} 