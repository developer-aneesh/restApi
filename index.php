<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once("config.php");
include_once ROOT_DIR . '/models/ApiBase.php';
require ROOT_DIR . '/controller/UserController.php';

$rateLimit = new ApiBase();
$controller = new UserController();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
$param = isset($uri[5]) ? $uri[5] : '';
if (!isset($uri[3]) || (isset($uri[3]) && $uri[3] != 'users')) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

if ($rateLimit->check()) {
    $controller->{$uri[4]}($param);
} else {
    $rateLimit->apiResponse(429, 'Too many requests in a short time. Pls check after some time');
}