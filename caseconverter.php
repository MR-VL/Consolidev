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
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
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
    </style>
</head>
<body>
<!-- Form for text conversion -->
<form method="POST" action="">
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
    <button type="submit" class="button">Submit</button>
</form>

<!-- Text box for the result -->
<textarea id="result" name="result"><?php if(isset($display)) echo htmlspecialchars($display); ?></textarea>

</body>
</html>