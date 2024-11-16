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
	<link rel="stylesheet" href="CSS/styles.css">
	<link rel="stylesheet" href="CSS/markdowntohtml.css">
	<script src="https://kit.fontawesome.com/d0af7889fc.js" crossorigin="anonymous"></script>
</head>
<body>
	<?php include 'header.php'; ?>
	
	<main>
		<div class="tool-header">
			<i class="fa-solid fa-code"></i>
			<h1>Markdown to HTML Converter</h1>
		</div>

		<form action="" method="post" class="markdown-form">
			<label for="markdown">Markdown Input:</label>
			<textarea id="markdown" name="markdown" rows="10" cols="50" placeholder="Enter Markdown here..."><?php echo isset($markdown) ? $markdown : ''; ?></textarea>
			<input type="submit" value="Convert" class="button">

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
		</form>

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
	</main>
	
	<footer>
		<p>&copy; <span id="2024"></span> consoliDev. All Rights Reserved.</p>
	</footer>
</body>
</html>