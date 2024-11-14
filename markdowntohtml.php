<?php
require_once 'init.php';

session_start();

//if user not logged in redirect to login screen
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

//store their username to be used later
$username = $_SESSION['username'];
require_once 'Libraries/Parsedown.php'; // Make sure this path is correct
$parsedown = new Parsedown();

// Initialize variables
$html = '';
$markdown = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve the raw Markdown input
    $markdown = $_POST['markdown'];

    // Check if the markdown contains special characters that need escaping
    if (preg_match('/[<>&"\'\x00-\x1F\x7F]/', $markdown)) {
        // If special characters are found, escape them
        $markdown = htmlspecialchars($markdown, ENT_QUOTES, 'UTF-8');
    }

    // Convert the Markdown to HTML
    $html = $parsedown->text($markdown);

    try {
        global $connect;
    $sql = "INSERT INTO markdowntohtml (username, markdown, html,date) 
    VALUES (:username, :markdown, :html, CURRENT_TIMESTAMP)";
    
        // Prepare the statement
        $stmt = $connect->prepare($sql);
    
        // Bind the parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':markdown', $markdown);
        $stmt->bindParam(':html', $html);
        $stmt->execute();
    } catch (exception $e) {
        $display = "Error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Markdown to HTML Converter</title>
    <style>
        .container {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }
        .container > div {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
        }
        textarea {
            width: 100%;
            max-width: 100%;
        }
        .raw-html {
            white-space: pre-wrap;
            background-color: #f4f4f4;
        }
        .tooltip {
            display: inline-block;
            position: relative;
            cursor: pointer;
            font-size: 14px;
            color: #007bff;
        }
        .tooltip .tooltiptext {
            visibility: hidden;
            width: 200px;
            background-color: #6c757d;
            color: #fff;
            text-align: center;
            border-radius: 5px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 125%; /* Position above the text */
            left: 50%;
            margin-left: -100px; /* Center the tooltip */
            opacity: 0;
            transition: opacity 0.3s;
        }
        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>
<body>

    <h1>Markdown to HTML Converter</h1>
    <form action="" method="post">
        <label for="markdown">Markdown Input:</label>
        <textarea id="markdown" name="markdown" rows="10" cols="50" placeholder="Enter Markdown here..."><?php echo isset($markdown) ? $markdown : ''; ?></textarea><br>
        <input type="submit" value="Convert">
    </form>

    <div class="tooltip">
        <span class="tooltiptext">
            Markdown Syntax:
            <ul>
                <li># Header 1</li>
                <li>## Header 2</li>
                <li>**Bold text**</li>
                <li>*Italic text*</li>
                <li>- List item</li>
                <li>1. Ordered list item</li>
            </ul>
        </span>
        <strong>How to...</strong>
    </div>

    <?php if ($html): ?>
        <div class="container">
            <div>
                <h2>Markdown</h2>
                <!-- displays original Markdown input (escaped if necessary) -->
                <textarea rows="10" readonly><?php echo isset($markdown) ? $markdown : ''; ?></textarea>
            </div>
            <div>
                <h2>HTML Source Code</h2>
                <!-- HTML as raw source code -->
                <textarea class="raw-html" rows="10" readonly><?php echo htmlspecialchars($html); ?></textarea>
            </div>
            <div>
                <h2>Rendered HTML Output</h2>
                <!-- renders the converted HTML -->
                <div><?php echo $html; ?></div>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>