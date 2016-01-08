<?php
require_once 'app/bootstrap/autoload.php';

$_SERVER['PHINX_MIGRATION_PATH']	= '%%PHINX_CONFIG_DIR%%/database/migrations/kelas';
$_SERVER['PHINX_SEEDER_PATH']		= '%%PHINX_CONFIG_DIR%%/database/seeder/kelas';
$_SERVER['PHINX_DB_DATABASE']		= getenv('KELAS_DB_DATABASE') ?: 'development';
$_SERVER['PHINX_DB_USERNAME']		= getenv('KELAS_DB_USERNAME') ?: 'root';
$_SERVER['PHINX_DB_PASSWORD']		= getenv('KELAS_DB_PASSWORD');
$_SERVER['PHINX_DB_PORT']			= getenv('KELAS_DB_PORT') ?: '3306';
$_SERVER['UNIX_SOCKET']				= getenv('UNIX_SOCKET') ?: '';
$_SERVER['PHINX_DB_PREFIX']			= getenv('KELAS_DB_PREFIX') ?: '';

return include 'phinx.php';
