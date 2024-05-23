<?php

require_once 'config/config.php';
require_once 'routes/web.php';
require_once 'main.php';
require_once 'controllers/AuthController.php';

session_start();

$env = parse_ini_file('.env');
$auth = ['login', 'register'];

$requestUrl = $_SERVER['REQUEST_URI'];

// Cari substring setelah direktori
$url = strstr($requestUrl, $dir);

// Jika substring ditemukan, hapus direktori dari substring
if ($url !== false) {
    $url = substr($url, strlen($dir));
} else {
    $url = $requestUrl;
}
$_SESSION['url'] = $url;

$title = $url == '/' ? 'Dashboard' : ucwords(str_replace(array('/', '-'), ' ', $url));
$_SESSION['title'] = $title;

if (array_key_exists($url, $routes)) {
    $route = $routes[$url];

    // Call the corresponding function based on the route from main.php
    if (function_exists($route)) {

        if (!isset($_SESSION['login'])) {
            if (in_array($route, $auth)) {
                call_user_func($route);
            } else {
                logout();
                exit();
            }
        } else {
            require 'src/elements/layouts/top.php';
            call_user_func($route);
            require 'src/elements/layouts/bottom.php';
        }
    } else {
        // Handle 404 - Function Not Found
        http_response_code(404);
        echo '404 - Function Not Found';
    }
} else if ($url == '/logout') {
    if (isset($_SESSION['login'])) {
        header('Location: ' . $dir);
    }
} else {
    // Handle 404 - Page Not Found
    http_response_code(404);
    echo '404 - Page Not Found';
}
