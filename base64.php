<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>NAME | Base 64</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

</head>
<body>

<h1> Base 64 page</h1>
</body>
</html>
