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
    <title>Consolidev | JWT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            display: flex;
            flex-direction: row;
            gap: 20px;
            max-width: 80vw;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="form">
        <form action="hashing.php" method="post">



        </form>
    </div>


    <div class="form" style="word-wrap: break-word">

        <a href="hashingHistory.php">
            <button class="btn" style="width:auto">View History</button>
        </a>
        <?php
        if(!empty($display)){
            echo $display;
        }
        ?>
    </div>
</div>
</body>