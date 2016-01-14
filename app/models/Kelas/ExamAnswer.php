<?php

namespace Model\Kelas;

class ExamAnswer extends Model
{
	protected $table = 'member_exam_answer';
	public $timestamps = false;

	public function member()
	{
		return $this->belongsTo(ExamMember::class, 'member_exam_id');
	}
}