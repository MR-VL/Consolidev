<?php
require_once 'database.php';

putenv("DB_HOST=localhost");
putenv("DB_USER=root");
putenv("DB_PASSWORD=");
putenv("DB_NAME=groupproject");


$database= new Database(
    getenv('DB_HOST'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASSWORD')
);

try {
    $connect = $database->getConnection();
    echo"<h1>Database connected</h1>";
}
catch (PDOException $e) {
    die("Database connection failed.");
}

?>