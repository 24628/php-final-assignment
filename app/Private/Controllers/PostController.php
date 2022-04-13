<?php
namespace App\Private\Controllers\PostController;

use App\Private\Controllers\MainController\MainController;
use App\Private\Models\Post;

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

        $html = '
            <div style="width: 100%;
                height: 100%;
                align-items: center;
                display: flex;
                justify-content: center;"
            >
                <form class="form-signin text-center" action="/post-update-save" method="post" style="min-width: 500px">
                    <h1 class="h3 mb-3 font-weight-normal">Update Post</h1>
                    <input type="hidden" value="'.$result["id"].'" name="update-id">
                    <input type="text" id="inputName" class="form-control" placeholder="Title" name="title" value="'.$result["title"].'" required autofocus>
                    <textarea style="height: 300px" class="form-control" placeholder="description" name="description">'.$result["description"].'</textarea>
            
                    <div style="width: 100%; display: flex; align-content: end; flex-direction: row-reverse;">
                        <button class="btn btn-lg btn-primary btn-block" style="width: 100px" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        ';

        $this->view($html);
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
