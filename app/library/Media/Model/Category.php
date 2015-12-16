<?php

namespace Library\Media\Model;

use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
	public function getLinkAttribute()
	{
		return site_url('category/' . $this->name);
	}

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function getMediaCount()
    {
        return $this->media->count();
    }

    public function getMediaDraftCount()
    {
        return $this->media()->onlyDrafts()->count();
    }

    public function getTotalSize()
    {
    	return $this->media->reduce(function ($carry, $media) {
    		return $carry + $media->file_size;
    	});
    }
}