<?php
namespace App\Private\Controllers\HomeController;

include "MainController.php";


use App\Private\Controllers\MainController\MainController;

class HomeController extends MainController {

    public function index(){

        $this->view(file_get_contents(str_replace("/Controllers", "", __DIR__ . '/views/Home.php')));
    }
}
