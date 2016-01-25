<?php

namespace Model\Kelas;

use Model\User;
use Model\Scopes\Published;

class ChapterComment extends Model
{
    use Published;
    
	protected $table = 'chapter_comments';
    protected $guarded = [];

	public function chapter()
	{
		return $this->belongsTo(Chapter::class);
	}

    public function replies()
    {
        return $this->hasMany(ChapterComment::class, 'parent')->orderBy('created_at', 'asc')->with('replies');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parent()
    {
        return $this->belongsTo(ChapterComment::class, 'parent');
    }

    public function scopeParentOnly($query, $parent_id = 0)
    {
        return $query->where('parent', $parent_id);
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