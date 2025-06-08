<?php
require_once "init.php";
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
$username = $_SESSION['username'];

$sql = "SELECT * FROM jwt WHERE username = :username";
global $connect;

try {
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $userHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<h1>Query failed:" . $e->getMessage() . "</h1>";
    ob_end_flush();
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Consolidev | JWT History</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="CSS/styles.css">
	<link rel="stylesheet" href="CSS/jwtHistory.css">

</head>
<main>
<body>

<?php include 'header.php'; ?>


<div class="history-container" style="word-wrap: break-word">


    <a href="jwt.php">
        <button class="btn">Go back</button>
        <br>
    </a>
    <table class="history-table">
		<thead>
			<tr>
				<th>Original</th>
				<th>Opposite</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($userHistory)) : ?>
				<?php foreach ($userHistory as $row): ?>
					<tr>
						<td><?= htmlspecialchars($row['encoded']) ?></td>
						<td><?= htmlspecialchars($row['decoded']) ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="2">No history entries found.</td>
				</tr>
			<?php endif; ?>
		</tbody>
    </table>
</div>
</main>

<footer>
	<p>&copy; <span id="2024"></span> consoliDev. All Rights Reserved.</p>
</footer>

</body>
</html>
