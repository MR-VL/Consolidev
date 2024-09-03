<?php

require_once 'init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Fname = filter_input(INPUT_POST, "Fname", FILTER_SANITIZE_SPECIAL_CHARS);
    $Lname = filter_input(INPUT_POST, "Lname", FILTER_SANITIZE_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if(!empty($Fname) && !empty($Lname) && !empty($username) && !empty($password)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        global $connect;
        $sql = "INSERT INTO user (Fname, Lname, username, password)
                VALUES(:Fname, :Lname, :username, :password)";

        $stmt = $connect->prepare($sql);

        $stmt -> bindParam(':Fname', $_POST["Fname"]);
        $stmt -> bindParam(':Lname', $_POST["Lname"]);
        $stmt -> bindParam(':username', $_POST["username"]);
        $stmt -> bindParam(':password', $passwordHash);
        if($stmt ->execute()) {
            echo "<h1>Thank you for registering!</h1>";
        }else{
            echo "<h1>Registration failed. Please try again later...</h1>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

</head>
<body>
    <form action="register.php" method="POST">


        <label for="Fname">First name</label>
        <input type ="text" id="Fname" name="Fname" placeholder="First Name" required><br><br>

        <label for="Lname">Last name</label>
        <input type ="text" id="Lname" name="Lname" placeholder="Last Name" required><br><br>

        <label for="username">Username</label>
        <input type ="text" id="username" name="username" placeholder="Username" required><br><br>

        <label for="password">Password</label>
        <input type ="password" id="password" name="password" placeholder="Password" required><br><br>

        <input type="submit" value="Register">
    </form>

</body>
</html>
