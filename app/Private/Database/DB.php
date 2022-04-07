<?php

namespace App\Private\Database;

use PDO;

class DB {

    private static ?DB $instance = null;
    private PDO $conn;

    private string $type = '';
    private string $host = "mysql";
    private string $user = "root";
    private string $pass = "secret123";
    private string $databaseName = "phpProject";

    private function __construct()
    {
        if(getenv('DATABASE_URL') != ""){
            $dbopts = parse_url(getenv('DATABASE_URL'));
            $this->type = "pgsql";
            $this->host = $dbopts["host"];
            $this->user = $dbopts["user"];
            $this->pass = $dbopts["pass"];
            $this->databaseName = ltrim($dbopts["path"], '/');
            $this->conn = new PDO("$this->type:host=$this->host;dbname=$this->databaseName", $this->user, $this->pass);
        } else  {
            $this->conn = new PDO("mysql:host={$this->host};
    dbname={$this->databaseName}", $this->user,$this->pass,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        }

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

