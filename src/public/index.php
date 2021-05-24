<?php

define('ROOT', dirname(__DIR__));
define('SITE', 'https://' . $_SERVER['SERVER_NAME']);
// HTTPS is the base for any good security

session_start();

/*
The Following Router is very basic. For bigger routers, you might want to extract into it's own class
*/
$uri = $_GET['p'];

if (strlen($uri) === 0)
    $uri = "Global/read";

$params = explode('/', $uri);

$controller = $params[0] . 'Controller';
$action = $params[1] ?? 'default';

if (!file_exists(ROOT . '/Controllers/' . $controller . '.php')) {
    http_response_code("404");
    $controller = "GlobalController";
}

require_once(ROOT . '/Controllers/' . $controller . '.php');
$controller = new $controller();

$action = method_exists($controller, $action) ? $action : "default";
$controller->$action();
