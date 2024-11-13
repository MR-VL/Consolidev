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
    <style>
        .container {
            display: flex;
            flex-direction: row;
            gap: 20px;
            max-width: 80vw;
        }

        textarea {
            width: 100%;
            height: 50vh;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="form">
        <form action="Json.php" method="POST">
            <h1 style="color: #00008B">Validate Json</h1>
            <label for="input"></label>
            <textarea id="input" name="input" placeholder="Enter JSON" required></textarea><br><br>
            <input type="submit" value="Validate">
        </form>
    </div>

    <div class="form" style="word-wrap: break-word">
        <?php
        if (!empty($display)) {
            echo $display;
        }
        ?>
    </div>
</div>
</body>
</html>
