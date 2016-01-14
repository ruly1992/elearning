<?php
require_once 'app/bootstrap/autoload.php';

$_SERVER['PHINX_MIGRATION_PATH']	= '%%PHINX_CONFIG_DIR%%/database/migrations/faq';
$_SERVER['PHINX_SEEDER_PATH']		= '%%PHINX_CONFIG_DIR%%/database/seeder/faq';
$_SERVER['PHINX_DB_DATABASE']		= getenv('FAQ_DB_DATABASE') ?: 'development';
$_SERVER['PHINX_DB_USERNAME']		= getenv('FAQ_DB_USERNAME') ?: 'root';
$_SERVER['PHINX_DB_PASSWORD']		= getenv('FAQ_DB_PASSWORD');
$_SERVER['PHINX_DB_PORT']			= getenv('FAQ_DB_PORT') ?: '3306';
$_SERVER['UNIX_SOCKET']				= getenv('UNIX_SOCKET') ?: '';
$_SERVER['PHINX_DB_PREFIX']			= getenv('FAQ_DB_PREFIX') ?: '';

return include 'phinx.php';
