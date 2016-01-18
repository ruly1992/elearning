<?php

namespace Model\Kelas;

use Model\User;

class CourseComment extends Model
{
	protected $table = 'course_comments';

	public function course()
	{
		return $this->belongsTo(Course::class);
	}

    public function replies()
    {
        return $this->hasMany(CourseComment::class, 'parent')->orderBy('created_at', 'asc')->with('replies');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parent()
    {
        return $this->belongsTo(CourseComment::class, 'parent');
    }

    public function getAvatarAttribute()
    {
        if ($this->user) {
            return $this->user->avatar;
        } else {
            return asset('images/default_avatar_male.jpg');
        }
    }

    public function getStatusLabelAttribute()
    {
        if ($this->status == 'draft')
            return '<span class="label label-warning">Draft</span>';
        elseif ($this->status == 'publish')
            return '<span class="label label-success">Publish</span>';
        else
            return '<span class="label label-secondary">'.$this->status.'</span>';
    }
}