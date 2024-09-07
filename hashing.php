<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Consolidev | Hashing</title>
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
            <label for="hash">Enter a value and choose hashing algorithm</label>
            <br>

            <div style="display: inline-flex">
                <input type="radio" id="encode" name="ans" value="encode" required>
                <label for="encode">Encode</label>
            </div>
            <br>
            <div style="display: inline-flex; margin-top: 3vh">
                <input type="radio" id="decode" name="ans" value="decode" required>
                <label for="decode">Decode</label>
            </div>

            <input style="height: 20vh" type="text" id="hash" name="hash" placeholder="Type here" required><br><br>
            <input type="submit" value="Hash">
        </form>
    </div>


    <div class="form" style="word-wrap: break-word">

        <a href="hashingHistory.php">
            <button class="btn">View History</button>
        </a>
        <?php
        if(!empty($display)){
            echo $display;
        }
        ?>
    </div>
</div>
</body>
</html>