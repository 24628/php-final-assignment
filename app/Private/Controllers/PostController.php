<?php
namespace App\Private\Controllers\PostController;

use App\Private\Controllers\MainController\MainController;
use App\Private\Database\DB;
use PDO;


class PostController extends MainController {


    public function __construct()
    {
        if(!isset($_SESSION["name"])) {
            http_response_code(403);
            $this->Redirect("/");
        }
    }

    public function index(){

        $this->view(file_get_contents(str_replace("/Controllers", "", __DIR__ . '/views/Admin.php')));
    }

    public function create(){
        $this->view(file_get_contents(str_replace("/Controllers", "", __DIR__ . '/views/PostCreate.php')));
    }

    public function save($request){
        $title = htmlspecialchars($request["title"]);
        $description = htmlspecialchars($request["description"]);

        if(!isset($title) && !isset($description)){
            http_response_code(403);
            return;
        }

        $stmt = DB::getInstance()->getConnection()->prepare("INSERT INTO posts (title, description) VALUES (:title, :description)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->execute();

        $this->Redirect("/admin");
    }

    public function show(){

    }

    public function update(){

    }

    public function delete(){

    }

    public function getPosts()
    {
        $stmt = DB::getInstance()->getConnection()->prepare("SELECT * FROM posts");
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-type: application/json');
        echo json_encode( $result );
    }

}
