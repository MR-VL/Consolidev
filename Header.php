<?php
require_once "init.php";

if (isset($_GET['logout'])) {
	session_destroy();
	header("Location: index.php");
	exit();
}

if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
	
	$favorites = [];
	
	$sql = "SELECT * FROM favorites WHERE username = :username";
	$stmt = $connect->prepare($sql);
	$stmt->execute(['username' => $username]);
	$favoriteRow = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if ($favoriteRow) {
		$tools = [
			'Base64' => 'Base 64 Encrypt/Decrypt',
			'CaseConverter' => 'Case Converter',
			'DuplicateChecker' => 'Duplicate Finder',
			'DifferenceChecker' => 'Difference Checker',
			'Hashing' => 'Hashing Tools',
			'JSONValidator' => 'JSON Tools',
			'JWTDecoder' => 'JWT Decode',
			'MarkdownToHtmlConverter' => 'Markdown to HTML',
			'TimeStampConverter' => 'Timestamp Converter',
			'ParagraphtoOneLineConverter' => 'Paragraph to One Line',
		];
		
		foreach ($tools as $toolKey => $toolName) {
			if ($favoriteRow[$toolKey] == 1) {
				
				$toolsSql = "SELECT toolurl FROM tools WHERE toolname = :toolname";
				
				if (empty($toolsSql)) {
					echo "Error: SQL query is emtpy!<br>";
					continue;
				}
				
				echo "Debut: SQL = $toolsSql for tool = $toolKey<br>";
				
				$toolStmt = $connect->prepare($toolSql);
								
				$toolStmt->execute(['toolname' => $toolKey]);
				
				$tool = $toolStmt->fetch(PDO::FETCH_ASSOC);
				
				if ($tool) {
					$favorites[] = array('name' => $toolName, 'url' => $tool['toolurl']);
				} else {
					echo "Debug: No tool found for $toolKey<br>";
				}
			}
		}
	}
} else {
	$favorites = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>consoliDev</title>
	<link rel="stylesheet" href="CSS/styles.css">
</head>
<body>
	<header class="sticky-header">
		<nav class="favorites-bar">
			<?php
			if (count($favorites) > 0) {
				foreach ($favorites as $favorite) {
					echo '<a href="' . htmlspecialchars($favorite['url']) . '" class="favorite-link">' . htmlspecialchars($favorite['name']) . '</a>';
				}
			} else {
				echo '<p>No favorite tools found</p>';
			}
			?>
			
		</nav>
		<div class="logo-link">
			<a href="main.php">
				<img src="pics/consoliDev logo no text.png" alt="consoliDev logo" class="dropdown-icon">
			</a>
		</div>
		<div class="hamburger-container">
			
			<i class="fa-solid fa-bars" id="hamburgerButton"></i>
		</div>
									
			<div class="dropdown-menu" id="dropdownMenu">
				<a href="Main.php" class="highlight-link">Home</a>
				<a href="base64.php">Base 64 Encrypt/Decrypt</a>
				<a href="caseconverter.php">Case Converter</a>
				<a href="differencechecker.php">Difference Checker</a>
				<a href="duplicates.php">Duplicate Finder</a>
				<a href="hashing.php">Hashing Tools</a>
				<a href="Json.php">JSON Tools</a>
				<a href="JWT.php">JWT Decode</a>
				<a href="markdowntohtml.php">Markdown to HTML</a>
				<a href="paragraphtooneline.php">Paragraph to One Line</a>
				<a href="timestampconverter.php">Timestamp Converter</a>
				<a href="?logout=true" class="highlight-link">Logout</a>
			</div>
	</header>
	
	<script src="header.js"></script>
</body>
</html>
