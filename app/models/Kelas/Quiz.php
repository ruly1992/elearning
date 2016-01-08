<?php

namespace Model\Kelas;

use Hashids\Hashids;

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

	public function members()
	{
		return $this->hasMany(QuizMember::class, 'user_id');
	}

	public function getCodeHashAttribute()
	{
		$hashids = new Hashids('quizprivate123');

		return $hashids->encode($this->id);
	}

	public function scopeFindByCodeHash($query, $code)
	{
		$hashids = new Hashids('quizprivate123');

		return $query->where('id', $hashids->decode($code))->firstOrFail();
	}
}