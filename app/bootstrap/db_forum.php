<?php

$capsule->addConnection(array(
   'driver'    => getenv('DRIVER_ELOQUENT') ?: 'mysql',
   'host'      => getenv('FORUM_DB_HOST') ?: 'localhost',
   'database'  => getenv('FORUM_DB_DATABASE') ?: 'portal_learning',
   'username'  => getenv('FORUM_DB_USERNAME') ?: 'root',
   'password'  => getenv('FORUM_DB_PASSWORD') ?: '',
   'charset'   => 'utf8',
   'collation' => 'utf8_unicode_ci',
   'prefix'    => getenv('FORUM_DB_PREFIX') ?: '',
), 'forum');