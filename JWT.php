<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Consolidev | Base 64</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

</head>
<body>

<h1>JWT Tool</h1>
</body>
</html>
