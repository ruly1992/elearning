<?php
require_once 'app/bootstrap/autoload.php';

$_SERVER['PHINX_MIGRATION_PATH']	= '%%PHINX_CONFIG_DIR%%/database/migrations/elibrary';
$_SERVER['PHINX_SEEDER_PATH']		= '%%PHINX_CONFIG_DIR%%/database/seeder/elibrary';
$_SERVER['PHINX_DB_DATABASE']		= getenv('ELIB_DB_DATABASE') ?: 'development';
$_SERVER['PHINX_DB_USERNAME']		= getenv('ELIB_DB_USERNAME') ?: 'root';
$_SERVER['PHINX_DB_PASSWORD']		= getenv('ELIB_DB_PASSWORD');
$_SERVER['PHINX_DB_PORT']			= getenv('ELIB_DB_PORT') ?: '3306';
$_SERVER['UNIX_SOCKET']				= getenv('UNIX_SOCKET') ?: '';
$_SERVER['PHINX_DB_PREFIX']			= getenv('ELIB_DB_PREFIX') ?: '';

return include 'phinx.php';
