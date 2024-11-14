<?php
require_once "init.php";
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
$display = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // need filter default of different one due to filter breaking valid json...
    $input = filter_input(INPUT_POST, "input", FILTER_DEFAULT);
    $errorCount = 0;
    $errors = array();

    if (!empty($input)) {
        $decoded = json_decode($input, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            $display = "<div style='color:green'>No Errors Detected</div>";
        } else {
            $errorCount++;
            $errors[] = json_last_error_msg();
            $display = "<div style='color:red'><strong>Invalid JSON:</strong><br>" . implode("<br>", $errors) . "</div>";
        }

        global $connect;
        $sql = "INSERT INTO json(username, input, errorCount, errors, date)
                VALUES (:username, :input, :errorCount, :errors, CURRENT_TIMESTAMP)";

        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':input', $input);
        $stmt->bindParam(':errorCount', $errorCount);
        $errorsString = implode(", ", $errors);
        $stmt->bindParam(':errors', $errorsString);
        $stmt->execute();
    } else {
        $display = "<div style='color: #00008B'><h2>Fatal Error.. Please retry</h2></div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Consolidev | JSON</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="CSS/styles.css">
	<link rel="stylesheet" href="CSS/Json.css">
	<script src="https://kit.fontawesome.com/d0af7889fc.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include('header.php'); ?>

<main class="main-container">

    <div class="form-container">
        <form action="Json.php" method="POST">
            <i class="fa-solid fa-code title-icon"></i>
			<h1 class="page-title">Validate Json</h1>
			
            <label for="input" class="input-label">Enter JSON:</label>
            <textarea id="input" name="input" placeholder="Enter JSON" required></textarea><br><br>
            <input type="submit" value="Validate" class="submit-btn">
        </form>
    </div>

    <div class="form-display">
        <?php
        if (!empty($display)) {
            echo $display;
        }
        ?>
    </div>
</main>

<footer>
	<p>&copy; <span id="2024"></span> consoliDev. All Rights Reserved.</p>
</footer>

</body>
</html>
