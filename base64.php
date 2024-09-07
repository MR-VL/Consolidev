<?php
session_start();
if(!isset($_SESSION['username'])) {
    header('Location: login.php');
}
$input = filter_input(INPUT_POST, "base64", FILTER_SANITIZE_SPECIAL_CHARS);

$type = $_POST["ans"];

if($type == "encode"){
    $type = 1;
}
else{
    $type = 2;
}

if($type == 1){
    $filtered = base64_encode($input);
    $display = "<div style='color: #00008B'><h2>Encoded Base 64:</h2><br> <h2>$filtered</h2></div>";
}
else{
    $filtered = base64_decode($input);
    $display = "<div style='color: #00008B'><h2>Decoded Base 64:</h2><br> <h2>$filtered</h2><br>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>NAME | Base 64</title>
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
        <form action="base64.php" method="post">
            <label for="base64">Enter a value and choose to encode or decode Base 64</label>
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
            <input style="height: 20vh" type="text" id="base64" name="base64" placeholder="Type here" required><br><br>
            <input type="submit" value="Convert">
        </form>
    </div>


    <div class="form">
        <?php
            if(!empty($display)){
                echo $display;
            }
        ?>
    </div>
</div>
</body>
</html>
