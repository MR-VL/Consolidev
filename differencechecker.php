<?php
//Session info
//initialize connection
require_once 'init.php';

//session management
session_start();

if(!isset($_SESSION['username'])) {
	header('Location: login.php');
	}
	
$username = $_SESSION['username'];
/*--------------------------------------------------------------------------*/
require_once 'C:\wamp64\www\Consolidev\DiffMatchPatch.php';
require_once 'C:\wamp64\www\Consolidev\DiffToolkit.php';
require_once 'C:\wamp64\www\Consolidev\Diff.php';
require_once 'C:\wamp64\www\Consolidev\Matcher.php';
require_once 'C:\wamp64\www\Consolidev\Patch.php';

use DiffMatchPatch\DiffMatchPatch;

$text1 = '';
$text2 = '';
$numDifferences = 0;
$highlightedText1 = '';
$highlightedText2 = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$text1 = filter_input(INPUT_POST, "text1", FILTER_SANITIZE_SPECIAL_CHARS);
	$text2 = filter_input(INPUT_POST, "text2", FILTER_SANITIZE_SPECIAL_CHARS);
	
	if(!empty($text1) && !empty($text2)) {
	
	// main program logic for difference checker
		$dmp = new DiffMatchPatch();
		$diffs = $dmp->diff_main($text1, $text2);
		$dmp->diff_cleanupSemantic($diffs);
		
		//Count differences
		foreach($diffs as $diff) {
			$operation = $diff[0];
			$text = htmlspecialchars($diff[1]);
			
			if ($operation == 0) {
				$highlightedText1 .= $text;
				$highlightedText2 .= $text;
			} elseif ($operation == -1) {
				$highlightedText1 .= "<span style = 'background-color: yellow;'>$text</span>";
			} elseif ($operation == 1) {
				$highlightedText2 .= "<span style='background-color: yellow;'>$text</span>";
			}
			if ($diff[0] !== 0) {
				$numDifferences += strlen($diff[1]);
			}
		}
		
		// Get the highlighted differences
		$highlightedDiffs = $dmp->diff_prettyHtml($diffs);
	
	
	//Database connection
	global $connect;
	
	$sql = "INSERT INTO differencechecker (username, date, differencesFound)
		VALUES(:username, CURRENT_TIMESTAMP, :differencesFound)";
		
	$stmt = $connect->prepare($sql);
	
	$stmt->bindParam(":username", $username);
	$stmt->bindParam(":differencesFound", $numDifferences);
	
	$stmt->execute();
	}
	else{
		$display = "<div style='color: #00008B'><h2>Fatal Error... Please retry</h2></div>";
		}
}
?>

<!-- html for the webpage! -->
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Consolidev | Difference Checker</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, intitial-scale=1" />
	<link rel="stylesheet" href="styles.css">
	<style>
		body {
			margin: 0;
			padding: 0;
			display: flex;
			flex-direction: column;
			align-items: center;
		}
		
		h1 {
			text-align:center;
			width: 100%;
			margin-bottom: 20px;
		}
		.container {
			display: flex;
			flex-direction: column;
			gap: 20px;
			max-width: 80vw;
			margin: auto;
		}
		
		.form-row {
			display: flex;
			justify-content: space-between;
			gap: 20px;
		}
		
		textarea {
			width: 48%;
			height: 200px;
		}
		
		.button {
			background-color: #38b6ff;
			color: white;
			padding: 10px;
			border: none;
			cursor: pointer;
			font-size: 16px;
		}
		
		.button:hover {
			background-color: #2a90cc;
		}
		
		.result-row {
			display: flex;
			justify-content: space-between;
			gap: 20px;
		}
			
		
		.result {
			font-size: 18px;
			color: #ff5733;
			width: 48%;
			border: 1px solid #ccc;
			padding: 10px;
			background-color: #f9f9f9;
		}
	</style>
</head>
<body>
<h1>Difference Checker</h1>
<div class="container">
	<!-- Form for text comparison -->
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<div class="form-row">
			<label for="text1">Text 1:</label>
			<label for="text2">Text 2:</label>
		</div>
		<div class="form-row">
			<textarea id="text1" name="text1" placeholder="Enter the first body of text" required><?php echo htmlspecialchars($text1); ?></textarea>
			<textarea id="text2" name="text2" placeholder="Enter the second body of text" required><?php echo htmlspecialchars($text2); ?></textarea>
		</div>
		
		<button type="submit" class="button">Compare</button>
	</form>

	<!-- Display the result -->
	<h2>Results</h2>
	<p>Number of Differences: <?php echo htmlspecialchars($numDifferences); ?></p>
	<div class="result-row">
		<div class="result">
			<h3>Text 1:</h3>
			<div><?php echo $highlightedText1; ?></div>
		</div>
	
		<div class="result">
			<h3>Text 2:</h3>
			<div><?php echo $highlightedText2; ?></div>
		</div>
	</div>
</div>

</body>
</html>