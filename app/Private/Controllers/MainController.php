<?php
namespace App\Private\Controllers\MainController;

require str_replace("/Controllers", "", __DIR__ . "/Database/DB.php");
require str_replace("/Controllers", "", __DIR__ . "/Models/User.php");
require str_replace("/Controllers", "", __DIR__ . "/Models/Post.php");
require str_replace("/Controllers", "", __DIR__ . "/helpers/Template.php");

use JetBrains\PhpStorm\NoReturn;

class MainController {

    protected function view($view){

        $navbar = file_get_contents(str_replace("/Controllers", "", __DIR__ . '/views/layout/NavBar.php'));
        $footer = file_get_contents(str_replace("/Controllers", "", __DIR__ . '/views/layout/Footer.php'));


        echo $navbar .
            $this->navbar() .
            $view .
            $footer;
    }

    #[NoReturn] protected function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }

    private function navbar(): string
    {
        if(isset($_SESSION["name"])) {
            return
            '<nav class="navbar navbar-expand-lg navbar-light bg-light">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                </ul>
            </nav>';
        } else {
            return '<nav class="navbar navbar-expand-lg navbar-light bg-light">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                </ul>
            </nav>';
        }
    }

}
