<?php

namespace App\Private\Controllers\HomeController;

include "MainController.php";

use App\Private\Controllers\MainController\MainController;
use App\Private\Models\Post;
use \Template;

class HomeController extends MainController
{

    public function index()
    {
        $result = Post::getAllPost();

        $template = new Template(dirname(__DIR__, 1)."/views", ['lang' => 'en']);
        echo $template->render('Home.php', ['posts' => $result]);
    }
}
