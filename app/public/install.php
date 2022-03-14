<?php

require str_replace("/public", "", __DIR__ . "/Private/Database/DB.php");

use App\Private\Database\DB;

error_reporting(E_ALL);
ini_set("display_errors", 1);

$connection = DB::getInstance()->getConnection();
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $connection->query("CREATE TABLE `posts` (
      `id` int(11) NOT NULL,
      `title` varchar(200) NOT NULL,
      `description` varchar(2000) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    $connection->query("CREATE TABLE `users` (
      `id` int(11) NOT NULL,
      `name` varchar(100) NOT NULL,
      `password` varchar(100) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
}

try {
    $connection->query(  "INSERT INTO `users` (`id`, `name`, `password`) VALUES (1, 'admin', 'password');");

    $connection->query(  "INSERT INTO `posts` (`id`, `title`, `description`) VALUES
(2, 'Some title 2', 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially '),
(3, 'Second title', 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially ');");
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
}

unlink(__FILE__);
