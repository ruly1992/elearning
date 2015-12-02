<?php

$capsule->addConnection(array(
   'driver'    => getenv('DRIVER_ELOQUENT') ?: 'mysql',
   'host'      => getenv('KONSULTASI_DB_HOST') ?: 'localhost',
   'database'  => getenv('KONSULTASI_DB_DATABASE') ?: 'portal_learning',
   'username'  => getenv('KONSULTASI_DB_USERNAME') ?: 'root',
   'password'  => getenv('KONSULTASI_DB_PASSWORD') ?: '',
   'charset'   => 'utf8',
   'collation' => 'utf8_unicode_ci',
   'prefix'    => getenv('KONSULTASI_DB_PREFIX') ?: '',
), 'konsultasi');