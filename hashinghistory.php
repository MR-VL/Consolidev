<?php
require_once 'init.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
$username = $_SESSION['username'];

$sql = "SELECT * FROM hashing WHERE username = :username";
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
    <title>Consolidev | Hashing History</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="CSS/styles.css">
	<link rel="stylesheet" href="CSS/hashinghistory.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="history-container">
	<a href="hashing.php">
		<button class="btn">Go back</button>
        <br>
    </a>
    <div class="table-title" style="display: inline-flex; width: 100%">
        <h2 style="max-width: 40%">Your Queries</h2>

    </div>

    <table class="history-table">
        <thead>
			<tr>
				<th>Type</th>
				<th>Original</th>
				<th>Opposite</th>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($userHistory)) : ?>
				<?php foreach ($userHistory as $row) : ?>
					<tr>
						<td><?= htmlspecialchars($row['algorithm']) ?></td>
						<td><?= htmlspecialchars($row['original']) ?></td>
						<td><?= htmlspecialchars($row['opposite']) ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="3">No history entries found.</td>
				</tr>
			<?php endif; ?>
		</tbody>
    </table>
</div>
<footer>
	<p>&copy; <span id="2024"></span> consoliDev. All Rights Reserved.</p>
</footer>
</body>

</html>
