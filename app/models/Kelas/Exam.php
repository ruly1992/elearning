<?php

namespace Model\Kelas;

class Exam extends Model
{
	protected $table = 'exams';
	protected $guarded = [];
	

	public function course()
	{
		return $this->belongsTo(Course::class);
	}

	public function questions()
	{
		return $this->hasMany(ExamQuestion::class);
	}

	public function members()
	{
		return $this->hasMany(ExamMember::class, 'exam_id');
	}
}