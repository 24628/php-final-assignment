<?php

namespace App\Private\Database\MainController;

use PDO;

class DB {

    private static ?DB $instance = null;
    private PDO $conn;

    private string $host = "mysql";
    private string $user = "root";
    private string $pass = "secret123";
    private string $name = "phpProject";

    // The db connection is established in the private constructor.
    private function __construct()
    {
        $this->conn = new PDO("mysql:host={$this->host};
    dbname={$this->name}", $this->user,$this->pass,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance(): ?DB
    {
        if(!self::$instance)
        {
            self::$instance = new DB();
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->conn;
    }
}

//$instance = DB::getInstance();
//$conn = $instance->getConnection();
