<?php

$capsule->addConnection(array(
   'driver'    => getenv('DRIVER_ELOQUENT') ?: 'mysql',
   'host'      => getenv('PORTAL_DB_HOST') ?: 'localhost',
   'database'  => getenv('PORTAL_DB_DATABASE') ?: 'portal_learning',
   'username'  => getenv('PORTAL_DB_USERNAME') ?: 'root',
   'password'  => getenv('PORTAL_DB_PASSWORD') ?: '',
   'charset'   => 'utf8',
   'collation' => 'utf8_unicode_ci',
   'prefix'    => getenv('PORTAL_DB_PREFIX') ?: '',
), 'portal');