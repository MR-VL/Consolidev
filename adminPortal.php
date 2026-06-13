<?php

require_once 'init.php';

// Strict security layer adapted for your team's local development (http://localhost)
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 0); // Change to 1 on DEPLOY
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_samesite', 'Strict');

session_start();


if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}


if ($_SESSION['username'] !== 'admin' && (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin')) {

    try {
        global $connect;

        $IPAddress = $_SERVER["REMOTE_ADDR"];
        $log_username = $_SESSION['username'];
        $error_message = "Unauthorized admin portal access attempt from IP: " . $IPAddress;

        $sql = "INSERT INTO audit_log (username, date, error_message) 
                VALUES (:username, CURRENT_TIMESTAMP, :error)";

        $stmt = $connect->prepare($sql);

        $stmt->bindValue(':username', $log_username);
        $stmt->bindValue(':error', $error_message);

        $stmt->execute();
    }
    catch (Exception $e) {
        error_log("Audit log insertion failed: " . $e->getMessage());
    }

    header('Location: login.php');
    exit;
}

$username = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Consolidev | Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="CSS/styles.css">
    <script src="https://kit.fontawesome.com/d0af7889fc.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include('header.php'); ?>

<main class="content-wrapper">
    <div class="title-container">
        <i class="fa-solid fa-user-shield title-icon"></i>
        <h1 class="page-title">Secure Admin Portal</h1>
    </div>

    <div class="container">
        <div class="form">
            <h2>Welcome Back, Admin (<?php echo $username; ?>)</h2>
            <p>Your session is active and secure.</p>
        </div>
    </div>
</main>

<footer>
    <p>&copy; <span><?php echo date('Y'); ?></span> consoliDev. All Rights Reserved.</p>
</footer>
</body>
</html>