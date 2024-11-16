<?php
require_once "init.php";
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
	exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = $_SESSION['username'];
	$favorites = isset($_POST['favorites']) ? json_decode($_POST['favorites'], true) : [];
	
	
	$tools = [
		'base64',
		'caseconverter',
		'differencechecker',
		'duplicatechecker',
		'hashing',
		'jasonvalidator',
		'jwtdecoder',
		'markdowntohtmlconverter',
		'paragraphtoonelineconverter',
		'timestampconverter'
	];
	
	try {
		global $connect;
		
		$resetQuery = "UPDATE favorites SET ";
		$resetQuery .= implode(" = 0, ", $tools) . " = 0 WHERE username = :username";
		$resetStmt = $connect->prepare($resetQuery);
		$resetStmt->bindParam(':username', $username);
		$resetStmt->execute();
		
		if (!empty($favorites)) {
			$updateQuery = "UPDATE favorites SET ";
			$updates = [];
			foreach ($favorites as $tool) {
				if (in_array($tool, $tools)) {
					$updates[] = "$tool = 1";
				}
			}
			$updateQuery .= implode(", ", $updates) . " WHERE username = :username";
			$updateStmt = $connect->prepare($updateQuery);
			$updateStmt->bindParam(':username', $username);
			$updateStmt->execute();
		}
		
		header('Location: managefavorites.php?success=1');
		exit;
	} catch (Exception $e) {
		echo "Error updating favorites: " . $e->getMessage();
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Consolidev | Manage Favorites</title>
	<link rel="stylesheet" href="CSS/styles.css">
	<link rel="stylesheet" href="CSS/managefavorites.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	    <script>
            document.addEventListener("DOMContentLoaded", function () {
                const stars = document.querySelectorAll(".star");

                stars.forEach(star => {
                    star.addEventListener("click", function () {
                        star.classList.toggle("checked");

                        // Update hidden input with selected tools
                        let favorites = Array.from(document.querySelectorAll(".star.checked"))
                            .map(star => star.getAttribute("value"))
                            .join(",");
                        document.getElementById("favorites").value = JSON.stringify(favorites);
                    });
                });
            });
        </script>
</head>
<body>
	<?php include 'header.php'; ?>

	<main>
		<h1>Manage Favorites</h1>

		<form method="post" action="updatefavorites.php">
			<div class="tools-list">
				<div class="tool-card">
					<span class="fa fa-star star" value="Base64"></span>
					<i class="fa-solid fa-unlock-keyhole tool-icon"></i>
					<h3>Base 64</h3>
				</div>
				<div class="tool-card">
					<span class="fa fa-star star" value="JWTDecoder"></span>
					<i class="fa-solid fa-key tool-icon"></i>
					<h3>JWT Decode</h3>
				</div>
				<div class="tool-card">
					<span class="fa fa-star star" value="ParagraphtoOneLineConverter"></span>
					<i class="fa-solid fa-i-cursor tool-icon"></i>
					<h3>Paragraph to One Line Converter</h3>
				</div>
				<div class="tool-card">
					<span class="fa fa-star star" value="CaseConverter"></span>
					<i class="fa-solid fa-arrows-rotate tool-icon"></i>
					<h3>Case Converter</h3>
				</div>
				<div class="tool-card">
					<span class="fa fa-star star" value="Hashing"></span>
					<i class="fa-solid fa-hashtag tool-icon"></i>
					<h3>Hashing Tools</h3>
				</div>
				<div class="tool-card">
					<span class="fa fa-star star" value="JSONValidator"></span>
					<i class="fa-solid fa-terminal tool-icon"></i>
					<h3>JSON Tools</h3>
				</div>
				<div class="tool-card">
					<span class="fa fa-star star" value="MarkdownToHtmlConverter"></span>
					<i class="fa-solid fa-code tool-icon"></i>
					<h3>Markdown To HTML converter</h3>
				</div>
				<div class="tool-card">
					<span class="fa fa-star star" value="TimeStampConverter"></span>
					<i class="fa-solid fa-clock tool-icon"></i>
					<h3>Time Stamp Converter</h3>
				</div>
				<div class="tool-card">
					<span class="fa fa-star star" value="DuplicateFinder"></span>
					<i class="fa-solid fa-magnifying-glass tool-icon"></i>
					<h3>Duplicate Finder</h3>
				</div>
				<div class="tool-card">
					<span class="fa fa-star star" value="DifferenceChecker"></span>
					<i class="fa-solid fa-check-double tool-icon"></i>
					<h3>Difference Checker</h3>
				</div>
			</div>
		

            <!-- Hidden input for starred tools -->
            <input type="hidden" name="favorites" id="favorites" value="">
			<div class="button-container">
				<button type="submit" class="btn">Update Favorites</button>
			</div>
		</form>
        
	</main>
	<footer>
		<p>&copy; <span id="2024"></span> consoliDev. All Rights Reserved.</p>
	</footer>

</body>
</html>
