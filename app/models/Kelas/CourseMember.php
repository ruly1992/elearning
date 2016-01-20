<?php

namespace Model\Kelas;

use Model\User;

class CourseMember extends Model
{
	protected $table = 'course_member';
	protected $guarded = [];
	public $timestamps = false;

	public function course()
	{
		return $this->belongsTo(Course::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}