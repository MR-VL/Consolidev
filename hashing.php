<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Consolidev | Hashing</title>
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
        <form action="hashing.php" method="post">
            <label for="hash">Enter a value and choose hashing algorithm</label>
            <br>
            <div style="display: inline-flex">
                <div>
                    <div style="display: inline-flex; margin-top: 3vh">
                        <input type="radio" id="md2" name="ans" value="md2" required>
                        <label for="md2">MD-2</label>
                    </div>
                    <br>
                    <div style="display: inline-flex; margin-top: 3vh">
                        <input type="radio" id="md4" name="ans" value="md4" required>
                        <label for="md4">MD-4</label>
                    </div>
                    <br>
                    <div style="display: inline-flex; margin-top: 3vh">
                        <input type="radio" id="md5" name="ans" value="md5" required>
                        <label for="md5">MD-5</label>
                    </div>
                </div>
                <div style="margin-left: 3vw">
                    <div style="display: inline-flex; margin-top: 3vh">
                        <input type="radio" id="sha1" name="ans" value="sha1" required>
                        <label for="sha1">SHA-1</label>
                    </div>
                    <br>
                    <div style="display: inline-flex; margin-top: 3vh">
                        <input type="radio" id="sha256" name="ans" value="sha256" required>
                        <label for="sha256">SHA-256</label>
                    </div>
                    <br>
                    <div style="display: inline-flex; margin-top: 3vh">
                        <input type="radio" id="sha512" name="ans" value="sha512" required>
                        <label for="sha512">SHA-512</label>
                    </div>
                </div>
                <div style="margin-left: 3vw">
                    <div style="display: inline-flex; margin-top: 3vh">
                        <input type="radio" id="ripemd128" name="ans" value="ripemd128" required>
                        <label for="ripemd128">Ripemd-128</label>
                    </div>
                    <br>
                    <div style="display: inline-flex; margin-top: 3vh">
                        <input type="radio" id="ripemd256" name="ans" value="ripemd256" required>
                        <label for="ripemd256">Ripemd-256</label>
                    </div>
                    <br>
                    <div style="display: inline-flex; margin-top: 3vh">
                        <input type="radio" id="whirlpool" name="ans" value="whirlpool" required>
                        <label for="whirlpool">Whirlpool</label>
                    </div>
                </div>
                <div style="margin-left: 3vw">
                    <div style="display: inline-flex; margin-top: 3vh">
                        <input type="radio" id="snefru" name="ans" value="snefru" required>
                        <label for="snefru">Snefru</label>
                    </div>
                    <br>
                    <div style="display: inline-flex; margin-top: 3vh">
                        <input type="radio" id="crc32" name="ans" value="crc32" required>
                        <label for="crc32">CRC-32</label>
                    </div>
                    <br>
                    <div style="display: inline-flex; margin-top: 3vh">
                        <input type="radio" id="adler32" name="ans" value="adler32" required>
                        <label for="adler32">Adler32</label>
                    </div>
                </div>
            </div>



            <input style="height: 20vh" type="text" id="hash" name="hash" placeholder="Type here" required><br><br>
            <input type="submit" value="Hash">
        </form>
    </div>


    <div class="form" style="word-wrap: break-word">

        <a href="hashingHistory.php">
            <button class="btn">View History</button>
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