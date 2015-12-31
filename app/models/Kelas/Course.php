<?php

namespace Model\Kelas;

use Model\User;
use Model\Scopes\Published;

class Course extends Model
{
	use Published;

	protected $guarded = [];

	public static function boot()
	{
		parent::boot();

		Course::creating(function ($course) {
			$course->code = $course->generateCode();
		});
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}
	
	public function chapters()
	{
		return $this->hasMany(Chapter::class);
	}

	public function exam()
	{
		return $this->hasOne(Exam::class);
	}

	public function instructor()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

    public function scopePublished($query)
    {
        $query = $query->where('status', 'publish');

        return $query;
    }

	public function scopeUserId($query, $user)
	{
		return $query->where('user_id', $user->id);
	}

	public function scopeOnlyInstructor($query, User $user)
	{
		return $query->where('user_id', $user->id);
	}

	protected function generateCode($i = 1)
	{
		if ($i > 999) {
			throw new \Exception("Maximum generate code");

			return;
		}
			
		$prefix			= 'COURSE';

		$user_id		= $this->instructor->id;
		$category_id	= $this->category->id;

		$suffix			= str_pad($i, 3, '0', STR_PAD_LEFT);
		$generated		= $prefix.'.'.$user_id.'.'.$category_id.'.'.$suffix;

		if ($this->whereCode($generated)->count())
			return $this->generateCode(++$i);
			return $generated;
	}

	public function hasFeatured()
	{
		return (bool) $this->attributes['featured'];
	}

	public function getFeaturedImageAttribute()
	{
		return $this->hasFeatured() ? asset('kelas-content/'.$this->id.'/'.$this->featured) : '';
	}

    public function getStatusLabelAttribute()
    {
        $status = ucwords($this->status);

        if ($this->status == 'draft')
            $type = 'info';
        else
            $type = 'success';

        $html = '<div class="label label-'.$type.'">'.$status.'</div>';

        return $html;
    }
}