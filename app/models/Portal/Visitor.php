<?php

namespace Model\Portal;

use Model\User;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;

class Visitor extends Model
{
    protected $guarded = [];
    protected $interval = 7200;

    public function incrementTimes($increment = 1)
    {
        $now = Carbon::now();

        if ($now->diffInSeconds($this->updated_at) > $this->interval) {
            $this->times += $increment;
            $this->save();
        }

        return $this;
    }

    public function scopeCheckAccessVisitor($query, $access_url, $ip_address, User $user = null)
    {
        return $query->where('ip_address', $ip_address)
            ->where('access_url', $access_url)
            ->where('user_id', $user ? $user->id : null)
            ->first();
    }

    public function saveVisitor()
    {        
        $user       = auth()->user();
        $request    = Request::createFromGlobals();
        $access     = $request->getScheme() . '://' . $request->getHttpHost() . $request->getRequestUri();
        $client_ip  = $request->getClientIp();

        $visitor    = Visitor::checkAccessVisitor($access, $client_ip, $user ?: null);

        if ($visitor->count()) {
            $visitor->incrementTimes();
        } else {
            $visitor = Visitor::create([
                'ip_address'    => $client_ip,
                'access_url'    => $access,
                'user_id'       => $user ? $user->id : null,
            ]);
        }

        return $visitor;
    }
}