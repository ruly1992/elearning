<?php

define('PATH_ROOT',                     dirname(dirname(__DIR__)));
define('PATH_AVATAR',                   PATH_ROOT.'/'.getenv('PATH_AVATAR',                 'public/user/avatar');
define('PATH_PORTAL_MEDIA',             PATH_ROOT.'/'.getenv('PATH_PORTAL_MEDIA',           'public/portal-content');
define('PATH_ELIBRARY_UPLOAD',          PATH_ROOT.'/'.getenv('PATH_ELIBRARY_UPLOAD',        'app/files/elibrary');
define('PATH_FORUM_ATTACHMENT',         PATH_ROOT.'/'.getenv('PATH_FORUM_ATTACHMENT',       'app/files/forum-attachment');
define('PATH_KONSULTASI_ATTACHMENT',    PATH_ROOT.'/'.getenv('PATH_KONSULTASI_ATTACHMENT',  'app/files/konsultasi-attachment');
define('PATH_KELASONLINE_ATTACHMENT',   PATH_ROOT.'/'.getenv('PATH_KELASONLINE_ATTACHMENT', 'app/files/kelas-online');
