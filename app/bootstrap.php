<?php
/* ==================== SERVER ENVIRONEMENT =========================== */

use Dotenv\Dotenv;

define('IN_DEVELOPMENT', $_SERVER['SERVER_NAME'] === 'localhost');

/* ======================= SERVER FOLDERS ============================= */
define('ROOT_FOLDER', dirname(__DIR__));
define('APP_FOLDER', ROOT_FOLDER . '/app');
define('VIEWS_FOLDER', APP_FOLDER . '/views');
define('PUBLIC_FOLDER', ROOT_FOLDER . '/public');
define('DIST_FOLDER', PUBLIC_FOLDER . '/dist');

/* ============================ URLs ================================== */
$publicPathname = implode('/', array_diff(explode('/', PUBLIC_FOLDER), explode('/', $_SERVER['DOCUMENT_ROOT'])));
define('PUBLIC_URL', IN_DEVELOPMENT ? '//' . $_SERVER['SERVER_NAME'] . '/' . $publicPathname : '//' . $_SERVER['SERVER_NAME']);
define('PUBLIC_ASSETS_URL', PUBLIC_URL . '/dist');

/* ============================ Title ================================= */
define('SITE_NAME', 'TEST');

/* ======================= SERVER PROTOCOL ============================ */
if (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS'])) {
    define('PROTOCOL', 'https://');
} else {
    define('PROTOCOL', 'http://');
}

/* ========================= AUTOLOADER =============================== */
require_once ROOT_FOLDER . '/vendor/autoload.php';

$dotenv = new Dotenv(ROOT_FOLDER);
$dotenv->load();

/* ======================== DATABASE SETTINGS ========================= */
define('DB_HOST', getenv('DB_HOST'));
define('DB_PORT', getenv('DB_PORT'));
define('DB_NAME', getenv('DB_NAME'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASS', getenv('DB_PASS'));
define('DB_DSN', 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME);
define('DB_OPTIONS', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
