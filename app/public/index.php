<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require str_replace("/public", "", __DIR__ . "/Private/Controllers/HomeController.php");
require str_replace("/public", "", __DIR__ . "/Private/Controllers/LoginController.php");

use App\Private\Controllers\HomeController\HomeController;
use App\Private\Controllers\LoginController\LoginController;


$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/' :
        (new HomeController)->index();
        break;
    case '/login' :
        (new LoginController())->index();
        break;
    case '/logout' :
        (new LoginController())->logout();
    case '/login-post':
        (new LoginController())->post($_POST);
        break;
    case '/admin':
        (new LoginController())->post($_POST);
        break;
    default:
        http_response_code(404);
        echo "404";
        break;
}
//http://localhost:8080/ phpadmin location
//http://localhost:90/ site location
