<?php
require_once 'init.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

$username = $_SESSION['username'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = filter_input(INPUT_POST, "hash", FILTER_SANITIZE_SPECIAL_CHARS);

    if (!empty($input)) {
        $type = $_POST["ans"];
        if ($type == "md2") {
            $opposite = hash("md2", $input);
        } else if ($type == "md4") {
            $opposite = hash("md4", $input);
        } else if ($type == "md5") {
            $opposite = hash("md5", $input);
        } else if ($type == "sha1") {
            $opposite = hash("sha1", $input);
        } else if ($type == "sha256") {
            $opposite = hash("sha256", $input);
        } else if ($type == "sha512") {
            $opposite = hash("sha512", $input);
        } else if ($type == "ripemd128") {
            $opposite = hash("ripemd128", $input);
        } else if ($type == "ripemd256") {
            $opposite = hash("ripemd256", $input);
        } else if ($type == "whirlpool") {
            $opposite = hash("whirlpool", $input);
        } else if ($type == "snefru") {
            $opposite = hash("snefru", $input);
        } else if ($type == "crc32") {
            $opposite = hash("crc32", $input);
        } else {
            $opposite = hash("adler32", $input);
        }

        $display = "<div style='color: #00008B'><h2>Hash:</h2><br> <h2>$opposite</h2></div>";

//PUT LOGIC HERE FOR HASHING

        try {
            global $connect;
            $sql = "INSERT INTO hashing (username, algorithm, original, opposite, date)
            VALUES(:username, :algo, :input, :opposite, current_timestamp)";

            $stmt = $connect->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':algo', $type);
            $stmt->bindParam(':input', $input);
            $stmt->bindParam(':opposite', $opposite);

            $stmt->execute();
        } catch (exception $e) {
            $display = "Error: " . $e->getMessage();

        }

    } else {
        $display = "<div style='color: #00008B'><h2>Fatal Error.. Please retry</h2></div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Consolidev | Hashing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="CSS/styles.css">
	<link rel="stylesheet" href="CSS/hashing.css">
	<script src="https://kit.fontawesome.com/d0af7889fc.js" crossorigin="anonymous"></script>
    
</head>
<body>

<?php include 'header.php'; ?>
<main>
<div class="container">

    <div class="tool-title">
		<i class="fa-solid fa-hashtag"></i>
		<h1>Hashing Tool</h1>
	</div>
	
	<div class="form">
        <form action="hashing.php" method="post">
            <label for="hash">Enter a value and choose hashing algorithm:</label>
            <br>
            <div class="radio-group">
                <div class="radio-column">
                    <div class="radio-option">
                        <input type="radio" id="md2" name="ans" value="md2" required>
                        <label for="md2">MD-2</label>
                    </div>
                    <br>
                    <div class="radio-option">
                        <input type="radio" id="md4" name="ans" value="md4" required>
                        <label for="md4">MD-4</label>
                    </div>
                    <br>
                    <div class="radio-option">
                        <input type="radio" id="md5" name="ans" value="md5" required>
                        <label for="md5">MD-5</label>
                    </div>
                </div>
                <div class="radio-column">
                    <div class="radio-option">
                        <input type="radio" id="sha1" name="ans" value="sha1" required>
                        <label for="sha1">SHA-1</label>
                    </div>
                    <br>
                    <div class="radio-option">
                        <input type="radio" id="sha256" name="ans" value="sha256" required>
                        <label for="sha256">SHA-256</label>
                    </div>
                    <br>
                    <div class="radio-option">
                        <input type="radio" id="sha512" name="ans" value="sha512" required>
                        <label for="sha512">SHA-512</label>
                    </div>
                </div>
                <div class="radio-column">
                    <div class="radio-option">
                        <input type="radio" id="ripemd128" name="ans" value="ripemd128" required>
                        <label for="ripemd128">Ripemd-128</label>
                    </div>
                    <br>
                    <div class="radio-option">
                        <input type="radio" id="ripemd256" name="ans" value="ripemd256" required>
                        <label for="ripemd256">Ripemd-256</label>
                    </div>
                    <br>
                    <div class="radio-option">
                        <input type="radio" id="whirlpool" name="ans" value="whirlpool" required>
                        <label for="whirlpool">Whirlpool</label>
                    </div>
                </div>
                <div class="radio-column">
                    <div class="radio-option">
                        <input type="radio" id="snefru" name="ans" value="snefru" required>
                        <label for="snefru">Snefru</label>
                    </div>
                    <br>
                    <div class="radio-option">
                        <input type="radio" id="crc32" name="ans" value="crc32" required>
                        <label for="crc32">CRC-32</label>
                    </div>
                    <br>
                    <div class="radio-option">
                        <input type="radio" id="adler32" name="ans" value="adler32" required>
                        <label for="adler32">Adler32</label>
                    </div>
                </div>
            </div>


            <input class="hash-input" type="text" id="hash" name="hash" placeholder="Type here" required><br><br>
            <input type="submit" value="Hash">
        </form>
    </div>


    <div class="form hash-history">

        <a href="hashinghistory.php">
            <button class="history-btn" style="width:auto">View History</button>
        </a>
        <?php
        if (!empty($display)) {
            echo $display;
        }
        ?>
    </div>
</div>
</main>
<footer>
    <p>&copy; <span id="2024"></span> consoliDev. All Rights Reserved.</p>
</footer>
</body>
</html>