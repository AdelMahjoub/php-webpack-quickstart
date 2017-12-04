<?php

// https://packagist.org/packages/wyrihaximus/html-compress
use WyriHaximus\HtmlCompress\Factory;

// Load configuration and autoloader
require_once dirname(__DIR__) . '/app/bootstrap.php';

// HTML content minifier
$parser = Factory::construct();

// Get the requested page from the querystring
if(isset($_GET['url']) && !empty($_GET['url'])) {
    $url = htmlentities(trim(urldecode($_GET['url'])), ENT_QUOTES, 'UTF-8') . '.php';
} else {
    $url = 'home.php';
}

// Load content
ob_start();
if(file_exists(VIEWS_FOLDER. '/' . $url)) {
    require_once  VIEWS_FOLDER . '/' . $url . '';
} else {
    require_once VIEWS_FOLDER . '/not-found.php';
}
$content = ob_get_clean();

// Load view
ob_start();
require_once VIEWS_FOLDER . '/layouts/default.php';
$view = ob_get_clean();

// Render view and content
echo IN_DEVELOPMENT ? $view : $parser->compress($view);
