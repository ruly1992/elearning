<?php

if (!function_exists('auth')) {
    function auth($user = null)
    {
        return new Library\Auth\Auth($user);
    }
}

if (!function_exists('ion_auth')) {
    function ion_auth()
    {
        $CI =& get_instance();

        $CI->load->library('ion_auth');

        return $CI->ion_auth;
    }
}

if (!function_exists('user')) {
    function user($id = 0)
    {
        if ($id > 0) {
            $user = Model\User::findOrFail($id);

            return $user;
        } else {
            return auth()->user();
        }
    }
}
