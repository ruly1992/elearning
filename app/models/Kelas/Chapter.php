<?php

namespace Model\Kelas;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Model\User;

class Chapter extends Model
{
	public function course()
	{
		return $this->belongsTo(Course::class);
	}

	public function quiz()
	{
		return $this->hasOne(Quiz::class);
	}

	public function attachments()
	{
		return $this->hasMany(Attachment::class);
	}

    public function getBefore()
    {
        if ($this->order > 1) {
            return $this->newQuery()->where('course_id', $this->course_id)->where('order', $this->order-1)->first();
        }

        return null;
    }

    public function getNext()
    {
        try {
            return $this->newQuery()->where('course_id', $this->course_id)->where('order', $this->order+1)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function getContentPathAttribute()
    {
    	return $this->course->content_path . '/chapter_' . $this->id;
    }

    public function hasQuiz()
    {
    	return !$this->quiz->questions->isEmpty();
    }

    public function hasQuizMember(User $user)
    {
    	$position = $this->quiz->members->search(function ($member) use ($user) {
    		return $member->id === $user->id;
    	});

    	return !empty($position);
    }

    public function memberHasFinished(User $user)
    {
    	if ($this->hasQuiz()) {
    		return $this->hasQuizMember($user);
    	}

    	return true;
    }
}