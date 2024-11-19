<?php
//Session info
//initialize connection
require_once 'init.php';

//session management
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

$username = $_SESSION['username'];
/*--------------------------------------------------------------------------*/
require_once 'Libraries/DiffMatchPatch.php';
require_once 'Libraries/DiffToolkit.php';
require_once 'Libraries/Diff.php';
require_once 'Libraries/Matcher.php';
require_once 'Libraries/Patch.php';

use DiffMatchPatch\Libraries\DiffMatchPatch;

$text1 = '';
$text2 = '';
$numDifferences = 0;
$highlightedText1 = '';
$highlightedText2 = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text1 = filter_input(INPUT_POST, "text1", FILTER_SANITIZE_SPECIAL_CHARS);
    $text2 = filter_input(INPUT_POST, "text2", FILTER_SANITIZE_SPECIAL_CHARS);

    if (!empty($text1) && !empty($text2)) {

        // main program logic for difference checker
        $dmp = new DiffMatchPatch();
        $diffs = $dmp->diff_main($text1, $text2);
        $dmp->diff_cleanupSemantic($diffs);

        //Count differences
        foreach ($diffs as $diff) {
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

        try {
            //Database connection
            global $connect;

            $sql = "INSERT INTO differencechecker (username, date, differencesFound)
            VALUES(:username, CURRENT_TIMESTAMP, :differencesFound)";

            $stmt = $connect->prepare($sql);

            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":differencesFound", $numDifferences);

            $stmt->execute();
        } catch (exception $e) {
            $display = "Error: " . $e->getMessage();

        }

    } else {
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
    <meta name="viewport" content="width=device-width, intitial-scale=1"/>
    <link rel="stylesheet" href="CSS/styles.css">
	<link rel="stylesheet" href="CSS/differencechecker.css">
	<script src="https://kit.fontawesome.com/d0af7889fc.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include 'header.php'; ?>

<div class="form-title">
	<i class="fa-solid fa-check-double icon"></i>
	<h1>Difference Checker</h1>
</div>

<div class="container">
    <!-- Form for text comparison -->
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="form-row">
            <label for="text1">Text 1:</label>
            <label for="text2">Text 2:</label>
        </div>
        <div class="form-row">
            <textarea id="text1" name="text1" placeholder="Enter the first body of text"
                      required><?php echo htmlspecialchars($text1); ?></textarea>
            <textarea id="text2" name="text2" placeholder="Enter the second body of text"
                      required><?php echo htmlspecialchars($text2); ?></textarea>
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

<footer>
    <p>&copy; <span id="2024"></span> consoliDev. All Rights Reserved.</p>
</footer>

</body>
</html>