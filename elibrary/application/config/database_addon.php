<?php

$db['user'] = array(
	'dsn'	=> '',
	'hostname' => getenv('AUTH_DB_HOST') ?: 'localhost',
	'username' => getenv('AUTH_DB_USERNAME') ?: 'root',
	'password' => getenv('AUTH_DB_PASSWORD') ?: '',
	'database' => getenv('AUTH_DB_DATABASE') ?: 'portal_learning',
	'dbdriver' => getenv('AUTH_DB_DRIVER') ?: 'mysqli',
	'dbprefix' => getenv('AUTH_DB_PREFIX') ?: '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);