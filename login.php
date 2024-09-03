<?php
require_once "init.php";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);



    $sql = "SELECT password FROM user WHERE username = :username";
    global $connect;
    $stmt = $connect -> prepare($sql);


    $stmt -> bindParam(':username', $username);
    $stmt -> execute();

    $user = $stmt -> fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['password'])){
        echo "<h1>Successfully logged in</h1>";
    }



}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

</head>
<body>
<form action="login.php" method="POST">
    <label for="username">Username</label>
    <input type ="text" id="username" name="username" placeholder="Username" required><br><br>

    <label for="password">Password</label>
    <input type ="password" id="password" name="password" placeholder="Password" required><br><br>

    <input type="submit" value="Login">
</form>
</body>
</html>
