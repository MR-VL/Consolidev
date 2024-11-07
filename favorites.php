<?php
require_once 'init.php';
session_start();

// tool_id and the favorite status from the AJAX request
$tool_ID = isset($_POST['tool_ID']) ? (int)$_POST['tool_ID'] : 0;
$isFavorite = isset($_POST['isFavorite']) ? (int)$_POST['isFavorite'] : 0;
$username = $_SESSION['username'];  // username is stored in session

// if ($tool_ID <= 0 || ($isFavorite !== 0 && $isFavorite !== 1)) {
//     echo 'Invalid data received.';
//     exit;
// }

// checks if the tool already exists in the user's favorites table
$stmt = $conn->prepare("SELECT * FROM favorites WHERE tool_ID = ? AND username = ?");
$stmt->bind_param("is", $tool_ID, $username);
$stmt->execute();
$result = $stmt->get_result();

// if the user already has this tool favorited, update it
if ($result->num_rows > 0) {
    // updates favorite status
    $stmt = $conn->prepare("UPDATE favorites SET isFavorite = ? WHERE tool_ID = ? AND username = ?");
    $stmt->bind_param("iis", $isFavorite, $tool_ID, $username);
} else {
    // new favorite entry
    $stmt = $conn->prepare("INSERT INTO favorites (tool_ID, username, isFavorite) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $tool_ID, $username, $isFavorite);
}

$stmt->execute();
$stmt->close();
?>
