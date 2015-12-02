<?php

$capsule->addConnection(array(
   'driver'    => getenv('DRIVER_ELOQUENT') ?: 'mysql',
   'host'      => getenv('AUTH_DB_HOST') ?: 'localhost',
   'database'  => getenv('AUTH_DB_DATABASE') ?: 'portal_learning',
   'username'  => getenv('AUTH_DB_USERNAME') ?: 'root',
   'password'  => getenv('AUTH_DB_PASSWORD') ?: '',
   'charset'   => 'utf8',
   'collation' => 'utf8_unicode_ci',
   'prefix'    => getenv('AUTH_DB_PREFIX') ?: '',
), 'user');