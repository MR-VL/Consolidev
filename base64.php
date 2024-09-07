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
    echo "<h2>Encoded Base 64</h2>";
}
else{
    $filtered = base64_decode($input);
    echo "<h2>Decoded Base 64</h2>";
}

echo "<h2>$filtered</h2>";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>NAME | Base 64</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="form">
    <form action="base64.php">
        <label for="base64">Enter a value and choose to encode or decode Base 64</label>
        <div style="display: inline-flex">
            <input type="radio" id="encode" name="ans" value="encode" required>
            <label for="encode">Encode</label>
        </div>
        <br>
        <div style="display: inline-flex; margin-top: 3vh">
            <input type="radio" id="decode" name="ans" value="decode" required>
            <label for="decode">Decode</label>
        </div>


        <input style="height: 40vh" type ="text" id="base64" name="base64" placeholder="Type here" required><br><br>

        <input type="submit" value="Convert">
    </form>
</div>
</body>
</html>
