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
	<link rel="stylesheet" href="CSS/base64history.css">

</head>
<main>
<body>
<?php include 'header.php'; ?>

<div class="history-container">

    <a href="base64.php">
        <button class="btn">Go back</button>
        <br>
    </a>
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
				<?php foreach ($userHistory as $row): ?>
					<tr>
						<td><?= htmlspecialchars($row['type']) ?></td>
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
</main>

<footer>
	<p>&copy; <span id="2024"></span> consoliDev. All Rights Reserved.</p>
</footer>

</body>
</html>
