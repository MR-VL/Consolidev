<?php
include 'init.php';
session_start();
if(!isset($_SESSION['username'])) {
    header('Location: login.php');
}
$username = $_SESSION['username'];

$sql = "SELECT * FROM base64 WHERE username = :username";
global $connect;

try{
    $stmt = $connect->prepare($sql);
    $stmt -> bindParam(':username', $username);
    $stmt->execute();
    $userHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);

}catch(PDOException $e){
    echo "<h1>Query failed:" .$e->getMessage()."</h1>";
    ob_end_flush();
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Consolidev | Base 64 History</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="styles.css">

</head>
<body>
<div class="form" style="word-wrap: break-word">

    <a href="base64.php">
        <button class="btn">Go back</button><br>
    </a>
    <table border="1" style="width: 100%; text-align: center; border-collapse: collapse;">
        <tr>
            <th style="padding: 10px;">Type</th>
            <th style="padding: 10px;">Original</th>
            <th style="padding: 10px;">Opposite</th>
        </tr>
        <?php
        foreach ($userHistory as $row){
        echo "<tr><td style='padding: 10px;'>{$row['type']}</td><td style='padding: 10px;'>{$row['original']}</td><td style='padding: 10px;'>{$row['opposite']}</td></tr>";
        }
        ?>
    </table>



</div>
</body>
</html>
