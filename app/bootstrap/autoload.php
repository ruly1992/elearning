<?php

require __DIR__.'/../../vendor/autoload.php';
require 'path.php';

$dotenv = new Dotenv\Dotenv(dirname(dirname(__DIR__)));
$dotenv->load();

date_default_timezone_set(getenv('DATE_TIMEZONE') ?: 'Asia/Jakarta');

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

foreach (glob(__DIR__ . '/db_*.php') as $filedb) {
	include $filedb;
}

$capsule->setAsGlobal();
$capsule->bootEloquent();