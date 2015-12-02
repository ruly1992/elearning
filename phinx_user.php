<?php
require_once 'app/bootstrap/autoload.php';

$_SERVER['PHINX_MIGRATION_PATH']	= '%%PHINX_CONFIG_DIR%%/database/migrations/user';
$_SERVER['PHINX_DB_DATABASE']		= getenv('AUTH_DB_DATABASE') ?: 'development';
$_SERVER['PHINX_DB_USERNAME']		= getenv('AUTH_DB_USERNAME') ?: 'root';
$_SERVER['PHINX_DB_PASSWORD']		= getenv('AUTH_DB_PASSWORD');
$_SERVER['PHINX_DB_PORT']			= getenv('AUTH_DB_PORT') ?: '3306';
$_SERVER['UNIX_SOCKET']				= getenv('UNIX_SOCKET') ?: '';
$_SERVER['PHINX_DB_PREFIX']			= getenv('AUTH_DB_PREFIX') ?: '';

return include 'phinx.php';
