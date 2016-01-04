<?php

if (!function_exists('request')) {
    function request()
    {
        return Symfony\Component\HttpFoundation\Request::createFromGlobals();
    }
}

if (!function_exists('pagination')) {
    function pagination($collection, $perPage = 15, $path = '/', $template = null)
    {
        $page       = request()->query->get('page', 1);
        $paginate   = new Illuminate\Pagination\LengthAwarePaginator(
            $collection->forPage($page, $perPage),
            $collection->count(),
            $perPage,
            $page,
            ['path' => site_url($path)]
        );

        if ($template != null) {
            $paginate->presenter(function () use ($paginate, $template) {
                return new Library\Pagination\BootstrapCustomPresenter($paginate, $template);
            });
        }

        return $paginate;
    }
}