<?php

namespace Library\Visitor;

use Carbon\Carbon;
use Model\Portal\Article;
use Model\Portal\VisitorArticle;
use Model\Portal\Visitor as ClientVisitor;
use Symfony\Component\HttpFoundation\Request;

class Visitor
{
    public function countVisitorToday()
    {
        $today = Carbon::today();

        return $this->countVisitorByDay($today);
    }

    public function countVisitorByDay(Carbon $datetime = null)
    {
        if ($datetime == null)
            $datetime = Carbon::today();

        $from   = $datetime->copy()->startOfDay();
        $to     = $datetime->copy()->endOfDay();

        return $this->countVisitorByDateTime($from, $to);
    }

    public function countVisitorByWeek(Carbon $datetime = null)
    {
        if ($datetime == null)
            $datetime = Carbon::today();

        $from   = $datetime->copy()->startOfWeek();
        $to     = $datetime->copy()->endOfWeek();

        return $this->countVisitorByDateTime($from, $to);
    }

    public function countVisitorByMonth(Carbon $datetime = null)
    {
        if ($datetime == null)
            $datetime = Carbon::today();

        $from   = $datetime->copy()->startOfMonth();
        $to     = $datetime->copy()->endOfMonth();

        return $this->countVisitorByDateTime($from, $to);
    }

    public function countVisitorByDateTime(Carbon $from, Carbon $to = null)
    {
        $visitors   = $this->getVisitorByDateTime($from, $to);
        $count      = $visitors->reduce(function ($carry, $visitor) {
            return $carry + $visitor->times;
        });

        return $count;
    }

    public function getVisitorToday()
    {
        $today = Carbon::today();

        return $this->getVisitorByDay($today);
    }

    public function getVisitorByDay(Carbon $datetime = null)
    {
        if ($datetime == null)
            $datetime = Carbon::today();

        $from   = $datetime->copy()->startOfDay();
        $to     = $datetime->copy()->endOfDay();

        return $this->getVisitorByDateTime($from, $to);
    }

    public function getVisitorByWeek(Carbon $datetime = null)
    {
        if ($datetime == null)
            $datetime = Carbon::today();

        $from   = $datetime->copy()->startOfWeek();
        $to     = $datetime->copy()->endOfWeek();

        return $this->getVisitorByDateTime($from, $to);
    }

    public function getVisitorByMonth(Carbon $datetime = null)
    {
        if ($datetime == null)
            $datetime = Carbon::today();

        $from   = $datetime->copy()->startOfMonth();
        $to     = $datetime->copy()->endOfMonth();

        return $this->getVisitorByDateTime($from, $to);
    }

    public function getVisitorByDateTime(Carbon $from, Carbon $to = null)
    {
        if ($to == null)
            $to = $from->copy()->endOfDay();

        $visitors = ClientVisitor::whereBetween('updated_at', [$from, $to]);

        return $visitors->get();
    }

    public function getCountPostToday(Article $article)
    {
        $from   = Carbon::today()->startOfDay();
        $to     = Carbon::today()->endOfDay();

        $visitors = VisitorArticle::where('artikel_id', $article->id)->whereBetween('date', [$from, $to]);

        return $visitors->get();
    }

    public function getPostPopular()
    {
        return Article::popular()->get();
    }

    public function saveVisitor()
    {
        $user       = auth()->getUser();
        $request    = Request::createFromGlobals();
        $access     = $request->getScheme() . '://' . $request->getHttpHost() . $request->getRequestUri();
        $client_ip  = $request->getClientIp();

        $visitor    = ClientVisitor::checkAccessVisitor($access, $client_ip, $user ?: null);

        if ($visitor->count()) {
            $visitor->incrementTimes();
        } else {
            $visitor = ClientVisitor::create([
                'ip_address'    => $client_ip,
                'access_url'    => $access,
                'user_id'       => $user ? $user->id : null,
            ]);
        }

        return $visitor;
    }
}