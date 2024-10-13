<?php
require_once "init.php";
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
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