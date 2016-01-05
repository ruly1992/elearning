<?php

namespace Model\Kelas;

class QuizQuestion extends Model
{
	public function quiz()
	{
		return $this->belongsTo(Quiz::class);
	}

	public function chapter()
	{
		return $this->quiz->chapter;
	}
}