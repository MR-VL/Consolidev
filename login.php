<?php
require_once "init.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if (!empty($username) && !empty($password)) {

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
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['username'] = $username;
                header('Location: main.php');
                exit();
            } else {
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
    <title>Consolidev | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="login.css">
</head>
<body>

<div class="registration-form">
	<img src="consoliDev logo no bg.png" alt="consoliDev logo" class"logo">
	
    <form action="login.php" method="POST" class="login-form">
        <div class="field-group">
            <label for="username" class="field-label">Username</label>
            <input type="text" id="username" name="username" placeholder="Username" required><br><br>
        </div>

        <div class="field-group">
            <label for="password" class="field-label">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required><br><br>
        </div>

        <input type="submit" value="Login" class="submit-btn">
    </form>
	
    <a href="register.php">
        <button class="btn">Sign Up</button>
    </a>

</div>


</body>
</html>
