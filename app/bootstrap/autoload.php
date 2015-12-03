<?php

// Vendor autoload
require __DIR__.'/../../vendor/autoload.php';
require 'path.php';

// Loading konfigurasi dengan file .env
$dotenv = new Dotenv\Dotenv(dirname(dirname(__DIR__)));
$dotenv->load();

// Merubah default timezone waktu sesuai dengan konfigurasi di .env
date_default_timezone_set(getenv('DATE_TIMEZONE') ?: 'Asia/Jakarta');

// Booting database dengan Eloquent 
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection(array(
   'driver'    => getenv('DRIVER_ELOQUENT') ?: 'mysql',
   'host'      => getenv('DB_HOST') ?: 'localhost',
   'database'  => getenv('DB_DATABASE') ?: 'homestead',
   'username'  => getenv('DB_USERNAME') ?: 'homestead',
   'password'  => getenv('DB_PASSWORD') ?: 'secret',
   'charset'   => 'utf8',
   'collation' => 'utf8_unicode_ci',
   'prefix'    => getenv('DB_PREFIX') ?: '',
));

// Booting database dengan Eloquent per koneksi
foreach (glob(__DIR__ . '/db_*.php') as $filedb) {
	include $filedb;
}

$capsule->setAsGlobal();
$capsule->bootEloquent();

// Session
use Symfony\Component\HttpFoundation\Session\Session;

// Autentikasi user dan role
use Cartalyst\Sentinel\Native\Facades\Sentinel;

$config = new Library\Sentinel\SentinelBootstrapper(__DIR__.'/../config/sentinel.php');

Sentinel::instance($config);
