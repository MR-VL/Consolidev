<?php
//See Base64.php for explanation on what this does
require_once 'init.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
$username = $_SESSION['username'];

//sql statement to pull all created by user
$sql = "SELECT * FROM base64 WHERE username = :username";
global $connect;

//you need this try block in case user has no entries
try {
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    //fetches all the stuff the user created
    $userHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    //You can copy this entire catch block as is, in case above fails for whatever reason it will return the error
    //message to the user and exit
    echo "<h1>Query failed:" . $e->getMessage() . "</h1>";
    ob_end_flush();
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Consolidev | Base 64 History</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="CSS/styles.css">

</head>
<body>
<div class="form" style="word-wrap: break-word">

    <!--This is the HTML it needs a lot of styling due to being so zoomed in for some reason.... -->
    <a href="base64.php">
        <button class="btn">Go back</button>
        <br>
    </a>
    <table border="1" style="width: 100%; text-align: center; border-collapse: collapse;">
        <tr>
            <th style="padding: 10px;">Type</th>
            <th style="padding: 10px;">Original</th>
            <th style="padding: 10px;">Opposite</th>
        </tr>
        <?php
        //iterate through the userhistory and display each line in a table format, you can basically just copy it as it and only chage the variable in
        //$row['CHANGEME'] to whatever your tables column names are, you should ommit the username because it will be the same for the user and is unneccessary
        foreach ($userHistory as $row) {
            echo "<tr><td style='padding: 10px;'>{$row['type']}</td><td style='padding: 10px;'>{$row['original']}</td><td style='padding: 10px;'>{$row['opposite']}</td></tr>";
        }
        ?>
    </table>


</div>
</body>
</html>
