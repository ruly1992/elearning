<?php

namespace Model\Kelas;

use Model\User;

class ExamMember extends Model
{
	protected $table = 'member_exam';
	protected $dates = ['started_at', 'finished_at'];
	protected $guarded = [];
	public $timestamps = false;

	public function exam()
	{
		return $this->belongsTo(Exam::class);
	}

	public function answers()
	{
		return $this->hasMany(ExamAnswer::class, 'member_exam_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}