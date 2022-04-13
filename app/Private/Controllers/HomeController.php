<?php

namespace App\Private\Controllers\HomeController;

include "MainController.php";

use App\Private\Controllers\MainController\MainController;
use App\Private\Models\Post;

class HomeController extends MainController
{

    public function index()
    {
        $result = Post::getAllPost();


        $html = '<div style="margin: 20px 30px;">';
        foreach ($result as $post) {
            $html .= '
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">'.$post["title"].'</h5>
                        <p class="card-text">'.$post["description"].'</p>
                    </div>
                </div>
        ';
        }
        $html .= '</div>';

        $this->view($html);
    }
}
