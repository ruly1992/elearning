<?php

if (!function_exists('request')) {
    function request()
    {
        return Symfony\Component\HttpFoundation\Request::createFromGlobals();
    }
}

if (!function_exists('pagination')) {
    function pagination($collection, $perPage = 15, $path = '/')
    {
        $page       = request()->query->get('page', 1);
        $paginate   = new Illuminate\Pagination\LengthAwarePaginator(
            $collection->forPage($page, $perPage),
            $collection->count(),
            $perPage,
            $page,
            ['path' => site_url($path)]
        );

        return $paginate;
    }
}