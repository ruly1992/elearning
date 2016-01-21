<?php

namespace Model\Kelas;

use Hashids\Hashids;

class Attachment extends Model
{
    protected $hashids_salt = 'download123456qwertyuiop';

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

    public function scopeFindByHashids($query, $hashed)
    {
        $hashids    = new Hashids($this->hashids_salt);
        $id         = $hashids->decode($hashed);

        return $query->where('id', $id)->firstOrFail();
    }

    public function getLinkDownloadAttribute()
    {
        $hashids    = new Hashids($this->hashids_salt);
        $id         = $hashids->encode($this->id);

        return kelas_url('course/download/'.$id);
    }
}