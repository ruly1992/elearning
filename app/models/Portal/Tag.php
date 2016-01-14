<?php

namespace Model\Portal;

class Tag extends Model
{
	public $timestamps = false;

	public function articles()
	{
		return $this->belongsToMany(Article::class, 'artikel_has_tags', 'tags_id', 'artikel_id');
	}
}