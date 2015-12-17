<?php

$capsule->addConnection(array(
   'driver'    => getenv('DRIVER_ELOQUENT') ?: 'mysql',
   'host'      => getenv('VICON_DB_HOST') ?: 'localhost',
   'database'  => getenv('VICON_DB_DATABASE') ?: 'portal_learning',
   'username'  => getenv('VICON_DB_USERNAME') ?: 'root',
   'password'  => getenv('VICON_DB_PASSWORD') ?: '',
   'charset'   => 'utf8',
   'collation' => 'utf8_unicode_ci',
   'prefix'    => getenv('VICON_DB_PREFIX') ?: '',
), 'vicon');