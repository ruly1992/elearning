<?php

namespace Model\Portal;

use Model\User;
use Carbon\Carbon;

class VisitorArticle extends Model
{
	protected $table = 'visitor_artikel';
    protected $interval = 7200;
    protected $guarded = [];

	public function article()
	{
		return $this->belongsTo(Article::class);
	}

    public function incrementTimes($increment = 1)
    {
        $now = Carbon::now();

        if ($now->diffInSeconds($this->updated_at) > $this->interval) {
            $this->times += $increment;
            $this->save();
        }

        return $this;
    }

    public function scopeCheckAccessVisitor($query, Article $article, $ip_address, User $user = null)
    {
        return $query->where('ip_address', $ip_address)
        	->where('artikel_id', $article->id)
        	->where('user_id', $user ? $user->id : null)
        	->first();
    }
}