<?php

namespace Model\Kelas;

class Chapter extends Model
{
	public function course()
	{
		return $this->belongsTo(Course::class);
	}

	public function quiz()
	{
		return $this->hasMany(Quiz::class);
	}
}