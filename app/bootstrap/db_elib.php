<?php

$capsule->addConnection(array(
   'driver'    => getenv('DRIVER_ELOQUENT') ?: 'mysql',
   'host'      => getenv('ELIB_DB_HOST') ?: 'localhost',
   'database'  => getenv('ELIB_DB_DATABASE') ?: 'portal_learning',
   'username'  => getenv('ELIB_DB_USERNAME') ?: 'root',
   'password'  => getenv('ELIB_DB_PASSWORD') ?: '',
   'charset'   => 'utf8',
   'collation' => 'utf8_unicode_ci',
   'prefix'    => getenv('ELIB_DB_PREFIX') ?: '',
), 'elib');