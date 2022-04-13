<?php

namespace App\Private\Models;

use App\Private\Database\DB;
use PDO;

class Post {

    public static function save($title, $description){
        $stmt = DB::getInstance()->getConnection()->prepare("INSERT INTO posts (title, description) VALUES (:title, :description)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
    }

    public static function find($id){
        $stmt = DB::getInstance()->getConnection()->prepare("SELECT * FROM posts WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    public static function update($id, $title, $description){
        $stmt = DB::getInstance()->getConnection()->prepare("UPDATE posts SET title = :title, description = :description WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
    }

    public static function delete($id){
        $stmt = DB::getInstance()->getConnection()->prepare("DELETE FROM  posts WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public static function getAllPost(){
        $stmt = DB::getInstance()->getConnection()->prepare("SELECT * FROM posts");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
