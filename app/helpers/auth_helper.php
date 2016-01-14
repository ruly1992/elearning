<?php

if (!function_exists('auth')) {
    function auth()
    {
        return sentinel();
    }
}

if (!function_exists('sentinel')) {
    function sentinel()
    {
        $config = new Library\Sentinel\SentinelBootstrapper(__DIR__.'/../config/sentinel.php');

        return Cartalyst\Sentinel\Native\Facades\Sentinel::instance($config)->getSentinel();
    }
}

if (!function_exists('user')) {
    function user($user = null)
    {
        if ($user == null)
            return sentinel()->getUser();
        elseif ($user instanceof \Cartalyst\Sentinel\Users\UserInterface)
            return sentinel()->findById($user->id);
        elseif (is_numeric($user))
            return sentinel()->findById($user);
        else
            return null;
    }
}
