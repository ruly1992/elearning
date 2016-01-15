<?php

namespace Model\Kelas;

class Attachment extends Model
{
    public function getFilepathAttribute()
    {
        return $this->getBasepath($this->filename);
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function getBasepath($path = '')
    {
        $path = trim($path, '\\/');

        return PATH_KELASONLINE_CONTENT.'/'.$this->chapter->course_id.'/chapter_'.$this->chapter_id.'/'.$path;
    }

    public function getLinkDownloadAttribute()
    {
        return asset($this->chapter->course_id.'/chapter_'.$this->chapter_id.'/'.$this->filename);
    }
}