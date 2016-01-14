<?php

if (!function_exists('home_url')) {
    function home_url($uri = '')
    {
        $home_url   = trim(getenv('HOME_URL'), '/') ?: 'http://' . $_SERVER['HTTP_HOST'];
        $uri        = trim($uri, '/');

        return $home_url . '/' . $uri;
    }
}

if (!function_exists('home_base_url')) {
    function home_base_url($uri = '')
    {
        $home_url   = trim(getenv('BASE_URL')) ?: 'http://' . $_SERVER['HTTP_HOST'];
        $uri        = trim($uri, '/');
        
        return $home_url . '/' . $uri;
    }
}

if (!function_exists('login_url')) {
    function login_url()
    {
        return home_url('auth/login');
    }
}

if (!function_exists('logout_url')) {
    function logout_url()
    {
        return home_url('auth/logout');
    }
}

if (!function_exists('dashboard_url')) {
    function dashboard_url($uri = '')
    {
        return home_url('dashboard/' . trim($uri, '/'));
    }
}

if (!function_exists('admin_url')) {
    function admin_url($uri = '')
    {
        return home_url('admin/' . trim($uri, '/'));
    }
}

if (!function_exists('portal_url')) {
    function portal_url($uri = '')
    {
        return home_url($uri);
    }
}

if (!function_exists('elib_url')) {
    function elib_url($uri = '')
    {
        return home_url('elibrary/' . trim($uri, '/'));
    }
}

if (!function_exists('virtualclass_url')) {
    function virtualclass_url($uri = '')
    {
        return kelas_url($uri);
    }
}

if (!function_exists('kelas_url')) {
    function kelas_url($uri = '')
    {
        return home_url('kelas-online/' . trim($uri, '/'));
    }
}

if (!function_exists('vicon_url')) {
    function vicon_url($uri = '')
    {
        return 'http://122.200.145.155/' . trim($uri, '/');
    }
}

if (!function_exists('forum_url')) {
    function forum_url($uri = '')
    {
        return home_url('forum/' . trim($uri, '/'));
    }
}

if (!function_exists('konsultasi_url')) {
    function konsultasi_url($uri = '')
    {
        return home_url('konsultasi/' . trim($uri, '/'));
    }
}
