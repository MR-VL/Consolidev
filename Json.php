<?php
require_once "init.php";
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = filter_input(INPUT_POST, "input", FILTER_SANITIZE_STRING);
    $output = "";
    $valid = false;
    $errorCount = 0;
    $errors = array();
    if(!empty($input)){

        try {
            //put validation parts here
            $input;
        }
        catch(Exception $e) {
            $output = $e->getMessage();
        }
    }

    global $connect;
    $sql = "INSERT INTO json(username, input, errorCount, errors, date)
    VALUES (:username, :input, :errorCount, :errors, :CURRENT_TIMESTAMP)";

    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':input', $input);
    $stmt->bindParam(':opposite', $opposite);
    $stmt->bindParam(':errorCount', $errorCount);
    $stmt->bindParam(':errors', $errors);
    $stmt->execute();

} else {
    $display = "<div style='color: #00008B'><h2>Fatal Error.. Please retry</h2></div>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Consolidev | JSON</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            display: flex;
            flex-direction: row;
            gap: 20px;
            max-width: 80vw;
        }
        textarea {
            width: 100%;
            height: 50vh;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="form">
        <form action="Json.php" method="post">
            <h1 style="color: #00008B">Validate Json</h1>
            <label for="input"></label>
            <textarea id="input" name="input" placeholder="Enter JSON" required></textarea><br><br>
            <input type="submit" value="Validate">
        </form>
    </div>

    <div class="form" style="word-wrap: break-word">
        <?php
        if(!empty($display)){
            echo $display;
        }
        ?>
    </div>
</div>
</body>
</html>