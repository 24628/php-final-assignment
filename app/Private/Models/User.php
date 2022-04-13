<?php

namespace App\Private\Models;

use App\Private\Database\DB;
use PDO;

class User {

    private string $name;
    private string $password;

    /**
     * @param $name
     * @param $password
     */
    public function __construct($name, $password)
    {
        $this->name = $name;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public static function login($name, $password): bool|array
    {
        $stmt = DB::getInstance()->getConnection()->prepare("SELECT * FROM users WHERE name=:name AND password=:password");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
