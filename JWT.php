<?php
    require_once "init.php";
    session_start();
    if(!isset($_SESSION['username'])){
        header('Location: login.php');
    }

    $username = $_SESSION['username'];
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $input = filter_input(INPUT_POST, "input", FILTER_SANITIZE_SPECIAL_CHARS);

        if(!empty($input)){
            $type = $_POST["ans"];
            if($type == "encode"){

            }
            else{

            }

        }
        $display = "<div style='color: #00008B'><h2>Output:</h2><br> <h2>$opposite</h2></div>";

        global $connect;



    }else{
        $display = "<div style='color: #00008B><h2>Fatal Error.. Please rerty</h2></div>";
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