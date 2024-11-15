<?php
/*session info*/
require_once 'init.php';
session_start();
if(!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
$username = $_SESSION['username'];
/*----------------------------------------*/
$newStr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = filter_input(INPUT_POST, "entry", FILTER_SANITIZE_SPECIAL_CHARS);

    if(!empty($input)) {
        $case = isset($_POST["case"]) ? $_POST["case"]: '';

        if ($case !== '') {
            if ($case == "camel")
            {
                $newStr = str_replace(' ', '', lcfirst(mb_convert_case($input, MB_CASE_TITLE, "UTF-8")));
            }
            else if ($case == "upper")
            {
                $newStr = mb_convert_case($input, MB_CASE_UPPER, "UTF-8");
            }
            else if ($case == "lower")
            {
                $newStr = mb_convert_case($input, MB_CASE_LOWER, "UTF-8");
            }
            else if ($case == "kebab")
            {
                $newStr = str_replace(' ', '-', $input);
            }
            else if ($case == "snake")
            {
                $newStr = str_replace(' ', '_', $input);
            } else {
                $newStr = "Please select a valid case option";
            }


            try{
                // Database interaction
                global $connect;

                $sql = "INSERT INTO caseconverter (username,date)
                VALUES(:username, CURRENT_TIMESTAMP)";

                $stmt = $connect->prepare($sql);
                $stmt->bindParam(":username", $username);


                $stmt->execute();
            } catch (PDOException $e) {
                $display = "Error: " . $e->getMessage();
            }

        }else {
            $newStr = "Please select a case option.";
        }
        $display = $newStr;

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Consolidev | Case Converter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="CSS/styles.css">
	<link rel="stylesheet" href="CSS/caseconverter.css">
	<script src="https://kit.fontawesome.com/d0af7889fc.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include 'header.php'; ?>

<!-- Form for text conversion -->
<div class="form-title">
	<i class="fa-solid fa-arrows-rotate icon"></i>
	<h1>Case Converter</h1>
</div>

<div class="container">
<form method="POST" action="" class="case-converter-form">
    <!-- The drop down list for the case -->
    <label for ="case">Choose a case:</label>

    <select name="case" id="case" required>
        <option value="upper">Upper case</option>
        <option value="lower">Lower case</option>
        <option value="camel">camelCase</option>
        <option value="kebab">kebab-case</option>
        <option value="snake">snake_case</option>
    </select>

    <!-- The text box for the user entry -->
    <textarea id="entry" name="entry" placeholder="Enter your text here" required></textarea>

    <!-- The button to submit the text to be converted -->
    <button type="submit" class="btn">Submit</button>
</form>

<div class="result-container">

	<!-- Text box for the result -->
	<label for ="result">Result:</label>
	<textarea id="result" name="result"><?php if(isset($display)) echo htmlspecialchars($display); ?></textarea>
</div>
</div>

<footer>
	<p>&copy; <span id="2024"></span> consoliDev. All Rights Reserved.</p>
</footer>
</body>
</html>