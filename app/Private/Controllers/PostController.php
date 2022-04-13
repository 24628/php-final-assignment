<?php
namespace App\Private\Controllers\PostController;

use App\Private\Controllers\MainController\MainController;
use App\Private\Models\Post;
use Template;

class PostController extends MainController {


    public function __construct()
    {
        if(!isset($_SESSION["name"])) {
            http_response_code(403);
            $this->Redirect("/");
        }
    }

    public function index(){

        $template = new Template(dirname(__DIR__, 1)."/views", ['lang' => 'en']);
        echo $template->render('Admin.php', []);
    }

    public function create(){
        $template = new Template(dirname(__DIR__, 1)."/views", ['lang' => 'en']);
        echo $template->render('PostCreate.php', []);
    }

    public function save($request){
        $title = htmlspecialchars($request["title"]);
        $description = htmlspecialchars($request["description"]);

        if(!isset($title) && !isset($description)){
            http_response_code(403);
            return;
        }

        Post::save($title, $description);

        $this->Redirect("/admin");
    }

    public function show($request){
        $id = htmlspecialchars($request["update-id"]);

        if(!isset($id)){
            http_response_code(403);
            return;
        }

        $result = Post::find($id);

        if(empty($result)){
            http_response_code(403);
            return;
        }

        $template = new Template(dirname(__DIR__, 1)."/views", ['lang' => 'en']);
        echo $template->render('PostUpdate.php', ['post' => $result]);
    }

    public function update($request){
        $id = htmlspecialchars($request["update-id"]);
        $title = htmlspecialchars($request["title"]);
        $description = htmlspecialchars($request["description"]);

        if(!isset($id) && !isset($title) && !isset($description)){
            http_response_code(403);
            return;
        }

        Post::update($id, $title, $description);

        $this->Redirect("/admin");
    }

    public function delete($request){
        $id = htmlspecialchars($request["delete-id"]);

        if(!isset($id)){
            http_response_code(403);
            return;
        }

        Post::delete($id);
        $this->Redirect("/admin");
    }

    public function getPosts()
    {
        header('Content-type: application/json');
        echo json_encode( Post::getAllPost() );
    }

}
