<?php

header('Content-Type: text/html; charset=UTF-8');
header('Pragma: no-cache');
header('Cache-Control: no-cache, must-revalidate');

session_start();

// URL
define('APP_URL', 'http://localhost:8000');

// Path
define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/..');
define('APPLICATION_PATH', BASE_PATH . '/application');
define('ROUTE_PATH', BASE_PATH . '/route');
define('TEMPLATE_PATH', BASE_PATH . '/template');

// PSR-4 Autoload
include_once BASE_PATH . '/vendor/autoload.php';

// Library Alias
foreach (App\Libraries\Loader::configs('libraryAlias') as $alias => $original) {
    class_alias($original, $alias);
}

// Route Setting
include_once ROUTE_PATH . '/index.php';
