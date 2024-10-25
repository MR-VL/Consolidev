<?php
// session information
require_once 'init.php';

session_start();

if(!isset($_SESSION['username'])) {
	header('Location: login.php');
	exit();
}
	
$username = $_SESSION['username'];
/*-------------------------------------------------------------------------------*/
//initialize the newstr variable to an empty string
$newStr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$input = filter_input(INPUT_POST, "entry", FILTER_UNSAFE_RAW);
	
/*-------------------------------------------------------------------------------*/
// Logic for the paragraph to one line tool

$newStr = trim(str_replace(array("\r\n", "\n", "\r"), ' ', $input));

// Database interaction
global $connect;

$sql = "INSERT INTO paragraphtoone (username, date) VALUES(:username, CURRENT_TIMESTAMP)";

$stmt = $connect->prepare($sql);
$stmt->bindParam(":username", $username);

$stmt->execute();

$display = $newStr;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Consolidev | Paragraph to One Line</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" href="styles.css">
	<style>
		.containter {
			display: flex;
			flex-direction: row;
			gap: 20px;
			max-width: 80vw;
		}
		.button {
			border:none;
			color: #38b6ff;
			text-align: center;
			font-size: 16px;
			cursor: pointer;
		}
		textarea#result {
			width: 100%;
			max-width: 100px;
			overflow-x: auto;
			white-space: nowrap;
	</style>
</head>
<body>
<!-- Form for text conversion -->
	<form method="POST" action="">
	
		<textarea id="entry" name="entry" placeholder="Enter your text here" required></textarea>
	
		<button type="submit" class="button">Submit</button>
	</form>
	
	<textarea id="result" name="result" readonly><?php if(isset($display)) echo htmlspecialchars($display, ENT_QUOTES, 'UTF-8'); ?></textarea>
	
</body>
</html>
