<?php
require_once "init.php";
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['username'];
    $favorites = isset($_POST['favorites']) ? explode(",", $_POST['favorites']) : [];
    global $connect;
    // Define all possible tools that can be favorited
    $allTools = [
        'APIRequestBuilder',
        'Base64',
        'CaseConverter',
        'DifferenceChecker',
        'DuplicateChecker',
        'Hashing',
        'JSONValidator',
        'JWTDecode',
        'MarkdownToHtmlConverter',
        'ParagraphtoOneLineConverter',
        'TimeStampConverter'
    ];

    // Initialize each tool as not favorited (0)
    $toolValues = array_fill_keys($allTools, 0);

    // Set selected tools as favorited (1)
    foreach ($favorites as $tool) {
        if (array_key_exists($tool, $toolValues)) {
            $toolValues[$tool] = 1;
        }
    }

    try {
        // Build the SQL query dynamically with placeholders
        $columns = implode(", ", array_keys($toolValues));
        $placeholders = ":" . implode(", :", array_keys($toolValues));

        // Insert or update the row based on the username
        $updateQuery = "
            INSERT INTO favorites (username, $columns) 
            VALUES (:username, $placeholders)
            ON DUPLICATE KEY UPDATE 
            " . implode(", ", array_map(function ($tool) {
                return "$tool = VALUES($tool)";
            }, array_keys($toolValues)));

        $stmt = $connect->prepare($updateQuery);

        // Bind the username parameter
        $stmt->bindValue(':username', $username);

        // Bind each tool value
        foreach ($toolValues as $tool => $isFavorite) {
            $stmt->bindValue(":$tool", $isFavorite, PDO::PARAM_INT);
        }

        // Execute the query
        $stmt->execute();

        echo "<h1>Favorites successfully updated.</h1>\n";
        echo "<h2>You will be redirected back to main in 2 seconds</h2>";
        echo "<hp>If you are not redirected <a href='main.php'>Click here</a></hp>";

        header('Refresh: 2; URL=main.php');
    } catch (PDOException $e) {
        echo "Error updating favorites: " . $e->getMessage();
    }
}
?>
