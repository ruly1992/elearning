<?php

namespace Library\Media\Model;

use Model\User;
use Carbon\Carbon;

class VisitorMedia extends Model
{
	protected $table = 'visitor_media';
    protected $interval = 7200;
    protected $guarded = [];

    public function incrementTimes($increment = 1)
    {
        $now = Carbon::now();

        if ($now->diffInSeconds($this->updated_at) > $this->interval) {
            $this->times += $increment;
            $this->save();
        }

        return $this;
    }

    public function scopeCheckAccessVisitor($query, Media $media, $ip_address, User $user = null)
    {
        return $query->where('ip_address', $ip_address)
            ->where('media_id', $media->id)
            ->where('user_id', $user ? $user->id : null)
            ->first();
    }
}