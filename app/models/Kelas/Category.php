<?php

namespace Model\Kelas;

class Category extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public static function boot()
    {
    	parent::boot();

    	Category::creating(function ($category) {
    		$category->slug	= $category->generateSlug();
    	});
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    protected function generateSlug($i = 0)
    {
    	$suffix		= $i ? '-'.$i : '';
    	$slugged	= \Illuminate\Support\Str::slug($this->name).$suffix;

    	if ($this->whereSlug($slugged)->count())
    		return $this->generateSlug(++$i);
    		return $slugged;
    }

    public function findBySlug($slug)
    {
        $course = $this->whereSlug($slug)->firstOrFail();

        return $course;
    }
}