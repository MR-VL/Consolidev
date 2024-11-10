<?php
require_once 'database.php';

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

putenv("DB_HOST=localhost");
putenv("DB_USER=root");
putenv("DB_PASSWORD=");
putenv("DB_NAME=consolidev");


$database = new Database(
    getenv('DB_HOST'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASSWORD')
);

try {
    global $connect;
    $connect = $database->getConnection();

} catch (PDOException $e) {
    echo "<h1>FATAL ERROR: Unable to connect to database</h1>";
    die("Database connection failed.");
}

?>