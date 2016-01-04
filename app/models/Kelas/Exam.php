<?php

namespace Model\Kelas;

class Exam extends Model
{
	protected $table = 'exams';

	public function course()
	{
		return $this->belongsTo(Course::class);
	}

	public function questions()
	{
		return $this->hasMany(ExamQuestion::class);
	}
}