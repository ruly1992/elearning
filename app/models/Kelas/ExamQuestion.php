<?php

namespace Model\Kelas;

class ExamQuestion extends Model
{
	protected $guarded = [];
	
	public function exam()
	{
		return $this->belongsTo(Exam::class);
	}

	public function course()
	{
		return $this->exam->course;
	}
}