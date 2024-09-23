<?php
require_once "init.php";
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
$display = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $input = filter_input(INPUT_POST, "input", FILTER_SANITIZE_SPECIAL_CHARS);

    if(!empty($input)){
        $type = $_POST["ans"];
        if($type == "encode"){

        } else {

            try {
                $parts = explode('.', $input);
                if (count($parts) !== 3) {
                    throw new Exception("Invalid JWT structure.");
                }

                $payload = $parts[1];
                $payload = str_replace(['-', '_'], ['+', '/'], $payload);
                $decoded = base64_decode($payload);

                if ($decoded === false) {
                    throw new Exception("Base64 decoding failed.");
                }


                $opposite = json_decode($decoded, false);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new Exception("JSON decoding error: " . json_last_error_msg());
                }


                $opposite = json_encode($opposite);

            } catch (Exception $e) {
                $opposite = json_encode(["error" => "Decoding Error: " . $e->getMessage()]);
            }
        }

        $display = "<div style='color: #00008B'><h2>Opposite:</h2><br> <h2>" . nl2br(htmlspecialchars($opposite)) . "</h2></div>";


        global $connect;
        $sql = "INSERT INTO jwt (username, original, opposite) 
                VALUES (:username, :input, :opposite)";

        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':input', $input);
        $stmt->bindParam(':opposite', $opposite);
        $stmt->execute();
    } else {
        $display = "<div style='color: #00008B'><h2>Fatal Error.. Please retry</h2></div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Consolidev | JWT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            display: flex;
            flex-direction: row;
            gap: 20px;
            max-width: 80vw;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="form">
        <form action="JWT.php" method="post">
            <div style="display: inline-flex; margin-top: 3vh">
                <input type="radio" id="encode" name="ans" value="encode" required>
                <label for="encode">Encode</label>

                <input type="radio" id="decode" name="ans" value="decode" style="margin-left: 5vw" required>
                <label for="decode">Decode</label>
            </div>
            <label for="input"></label>
            <input style="height: 20vh" type="text" id="input" name="input" placeholder="Type here" required><br><br>
            <input type="submit" value="Submit">
        </form>
    </div>

    <div class="form" style="word-wrap: break-word">
        <a href="jwtHistory.php">
            <button class="btn" style="width:auto">View History</button>
        </a>

        <?php
        if(!empty($display)){
            echo $display;
        }
        ?>
    </div>
</div>
</body>
</html>
