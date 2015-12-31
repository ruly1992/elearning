<?php

namespace Model\Kelas;

class ExamQuestion extends Model
{
	public function exam()
	{
		return $this->belongsTo(Exam::class);
	}

	public function course()
	{
		return $this->exam->course;
	}
}