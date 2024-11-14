<?php
require_once "init.php";
session_start();
include 'header.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
} else {
    $username = $_SESSION['username'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Consolidev | Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="CSS/styles.css">
    <link rel="stylesheet" href="CSS/Main.css">
    <script src="https://kit.fontawesome.com/d0af7889fc.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="landing-container">
    <!--Sidebar with logo and links-->
    <aside class="sidebar">
        <img src="pics/consoliDev logo no bg.png" alt="consoliDev Logo" class="logo">
        <ul class="sidebar-links">
            <li><a href="manageFavorites.php">Manage Favorites</a></li>
            <li><a href="profile.php">Manage Profile</a></li>
        </ul>
    </aside>

    <!-- Main welcome section -->
    <div class="welcome-section">
        <h1 class="welcome-title">Welcome back, <?php echo htmlspecialchars($username ?? 'User'); ?>!</h1>

        <!-- Tool cards section-->
        <div class="tool-cards">
            <a href="base64.php" class="tool-card">
                <i class="fa-solid fa-unlock-keyhole"></i>
                <h3>Base 64 Encrypt/ Decrypt</h3>
                <p>Quickly encode or decode text using Base64 encoding.</p>
            </a>
            <a href="JWT.php" class="tool-card">
                <i class="fa-solid fa-key"></i>
                <h3>JWT Decode</h3>
                <p>Decode JSON Web Tokens to view payload data.</p>
            </a>
            <a href="paragraphtooneline.php" class="tool-card">
                <i class="fa-solid fa-i-cursor"></i>
                <h3>Paragraph to One Line Converter</h3>
                <p>Convert multi-line paragraphs into a single line.</p>
            </a>
            <a href="caseconverter.php" class="tool-card">
                <i class="fa-solid fa-arrows-rotate"></i>
                <h3>Case Converter</h3>
                <p>Convert text between uppercase, lowercase, and more.</p>
            </a>
            <a href="duplicates.php" class="tool-card">
                <i class="fa-solid fa-magnifying-glass"></i>
                <h3>Duplicate Finder and Remover</h3>
                <p>Find, highlight, and remove duplicate lines or entries.</p>
            </a>
            <a href="differencechecker.php" class="tool-card">
                <i class="fa-solid fa-check-double"></i>
                <h3>Difference Checker</h3>
                <p>Compare two texts and highlight differences.</p>
            </a>
            <a href="Json.php" class="tool-card">
                <i class="fa-solid fa-code"></i>
                <h3>JSON Tools</h3>
                <p>Validate, format, and edit JSON data easily.</p>
            </a>
        </div>
    </div>
</div>

</body>
</html>