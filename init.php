<?php
require_once 'database.php';

putenv("DB_HOST=localhost");
putenv("DB_USER=root");
putenv("DB_PASSWORD=");
putenv("DB_NAME=gproject");

$database = new Database(
    getenv('DB_HOST'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASSWORD')
);

try {
    $connection = $database->getConnection();
}
catch (PDOException $e) {
    die("Database connection failed.");
}

?>