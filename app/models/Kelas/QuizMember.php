<?php

namespace Model\Kelas;

class QuizMember extends Model
{
	protected $table = 'member_quiz';
	public $timestamps = false;

	public function quiz()
	{
		return $this->belongsTo(Quiz::class);
	}
}