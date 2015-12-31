<?php

namespace Model\Kelas;

class Quiz extends Model
{
	protected $table = 'quiz';

	public function chapter()
	{
		return $this->belongsTo(Chapter::class);
	}

	public function questions()
	{
		return $this->hasMany(QuizQuestion::class);
	}
}