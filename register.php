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

    if(strlen($password) < 8 ){
        $valid = false;
        echo '<script>alert("Error: Password must be at least 8 characters long")</script>';
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
                // Redirect to login.php after successful registration
                echo "<h1>Account successfully registerd.</h1>\n";
                echo "<h2>You will be redirected back to Login in 2 seconds</h2>";
                echo "<p>If you are not redirected <a href='Login.php'>Click here</a></p>";
                header('Refresh: 2; URL=login.php');
				exit;
            } else {
                echo "<h1>Registration failed. Please try again later...</h1>";
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
    <link rel="stylesheet" href="CSS/styles.css">
	<link rel="stylesheet" href="CSS/register.css">
</head>

<body>

<div class="register-container">
	<div class="register-logo">
		<img src="pics/consoliDev logo no bg.png" alt="consoliDev logo">
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
		<p>Already have an account?</p>
		<a href="login.php"><button class="btn">Login</button></a>
	</div>
</div>


</body>
</html>
