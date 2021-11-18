<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require str_replace("/public", "", __DIR__ . "/Private/Controllers/HomeController.php");
require str_replace("/public", "", __DIR__ . "/Private/Controllers/LoginController.php");
require str_replace("/public", "", __DIR__ . "/Private/Controllers/PostController.php");

use App\Private\Controllers\HomeController\HomeController;
use App\Private\Controllers\LoginController\LoginController;
use App\Private\Controllers\PostController\PostController;


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
        (new PostController())->index();
        break;
    case '/post-create':
        (new PostController())->create();
        break;
    case '/post-save':
        (new PostController())->save($_POST);
        break;
    case '/get-posts':
        (new PostController())->getPosts();
        break;
    default:
        http_response_code(404);
        echo "404";
        break;
}
//http://localhost:8080/ phpadmin location
//http://localhost:90/ site location
