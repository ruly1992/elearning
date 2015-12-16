<?php

namespace Library\Media\Model;

class Metadata extends Model
{
	protected $table = 'metadata';
	protected $guarded = [];

	public $timestamps = false;

	public function media()
	{
		return $this->belongsTo(Media::class);
	}

	public function scopeMediaId($query, $media)
	{
		return $query->where('media_id', $media);
	}

	public function scopeByMediaKey($query, $media, $key)
	{
		return $query->mediaId($media)->where('key', $key);
	}
}