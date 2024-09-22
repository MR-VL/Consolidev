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
        <form action="jwtHistory.php" method="post">
            <div style="display: inline-flex; margin-top: 3vh">

                <input type="radio" id="encode" name="ans" value="encode" required>
                <label for="encode">Encode</label>


                <input type="radio" id="decode" name="ans" value="decode" style="margin-left: 5vw" required>
                <label for="decode">Decode</label>
            </div>
            <label for="input"></label>
            <input style="height: 20vh" type="text" id="input" name="input" placeholder="Type here" required><br><br>
            <input type="submit" value="Submit">


        </form>
    </div>


    <div class="form" style="word-wrap: break-word">

        <a href="jwtHistory.php">
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