<?php
require_once "init.php";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if(!empty($username) && !empty($password)){

        $sql = "SELECT password FROM user WHERE username = :username";
        global $connect;

        try {
            $stmt = $connect->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "<h1>Query failed: " . $e->getMessage() . "</h1>";
            ob_end_flush();
            exit();
        }

        if ($user) {
            if(password_verify($password, $user['password'])){
                header('Location: main.php');
                exit();
            }
            else{
                echo "<h1>Wrong password!</h1><br>";
            }
        } else {
            echo "<h1>User not found.</h1><br>";
        }
        ob_end_flush();
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
