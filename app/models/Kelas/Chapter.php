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
		return $this->hasOne(Quiz::class);
	}

	public function attachments()
	{
		return $this->hasMany(Attachment::class);
	}
}