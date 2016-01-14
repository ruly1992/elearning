<?php

namespace Model\Kelas;

use Model\User;

class QuizMember extends Model
{
	protected $table = 'member_quiz';
	protected $dates = ['started_at', 'finished_at'];
	protected $guarded = [];
	public $timestamps = false;

	public function quiz()
	{
		return $this->belongsTo(Quiz::class);
	}

	public function answers()
	{
		return $this->hasMany(QuizAnswer::class, 'member_quiz_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}