<?php

require_once 'init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Fname = filter_input(INPUT_POST, "Fname", FILTER_SANITIZE_SPECIAL_CHARS);
    $Lname = filter_input(INPUT_POST, "Lname", FILTER_SANITIZE_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);


    $valid = true;

    if (strlen($Fname) > 20 || strlen($Lname) > 20 || strlen($username) > 20 || strlen($password) > 20) {
        $valid = false;
        echo '<script>alert("Error: Maximum size for field input is 20 characters")</script>';
    }


    if (!empty($Fname) && !empty($Lname) && !empty($username) && !empty($password) && $valid) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);


        global $connect;
        $sql = "INSERT INTO user (Fname, Lname, username, password, DateJoined)
                VALUES(:Fname, :Lname, :username, :password, CURRENT_TIMESTAMP)";

        $stmt = $connect->prepare($sql);

        $stmt->bindParam(':Fname', $Fname);
        $stmt->bindParam(':Lname', $Lname);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $passwordHash);

        try {
            if ($stmt->execute()) {
                echo "<h1>Thank you for registering!</h1>";
                ob_end_flush();
            } else {
                echo "<h1>Registration failed. Please try again later...</h1>";
                ob_end_flush();
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "<h1>Username Already Exists<br>Please try again.</h1>";
            } else {
                echo "<h1>{$e->getTraceAsString()}</h1>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Consolidev | Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="register.css">
</head>

<body>

<div class="register-container">
	<div class="register-logo">
		<img src="consoliDev logo no bg.png" alt="consoliDev logo">
	</div>
	
	
    <form action="register.php" method="POST" class="registration-form">
        <label class="field-label">Maximum input size: 20 characters</label>


        <label for="Fname" class="field-label">First name</label>
        <input type="text" id="Fname" name="Fname" placeholder="First Name" required>

        <label for="Lname" class="field-label">Last name</label>
        <input type="text" id="Lname" name="Lname" placeholder="Last Name" required>

        <label for="username" class="field-label">Username</label>
        <input type="text" id="username" name="username" placeholder="Username" required>

        <label for="password" class="field-label">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" required>

		<label class="terms-checkbox">
			<input type="checkbox" required>I agree to the Terms of Service
		</label>
		
        <input type="submit" value="Register" class="register-btn">
    </form>


	<div class="login-link">
		<p>already have an account?</p>
		<a href="login.php"><button class="btn">Login</button></a>
	</div>
</div>


</body>
</html>
