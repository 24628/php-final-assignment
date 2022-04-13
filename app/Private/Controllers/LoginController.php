<?php
namespace App\Private\Controllers\LoginController;

use App\Private\Controllers\MainController\MainController;
use App\Private\Models\User;
use JetBrains\PhpStorm\NoReturn;
use Template;

class LoginController extends MainController {

    public function index(){

        $template = new Template(dirname(__DIR__, 1)."/views", ['lang' => 'en']);
        echo $template->render('Login.php', []);
    }

    public function post(array $request)
    {

        $name = htmlspecialchars($request["name"]);
        $password = htmlspecialchars($request["password"]);

        if(!isset($name) && !isset($password)){
            http_response_code(403);
            return;
        }

        $result = User::login($name, $password);

        if(empty($result)){
            http_response_code(403);
            return;
        }

        $user = new User($result[0]['name'], $result[0]['password']);
        $_SESSION["name"] = $user->getName();

        $this->Redirect($_SERVER["HTTP_ORIGIN"]);
    }

    #[NoReturn] public function logout()
    {
        session_unset();
        $this->Redirect("/");
    }
}
