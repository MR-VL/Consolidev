<?php
$host = 'localhost';
$db = 'consolidev';
$user = 'root'; // default WAMP user
$pass = ''; // default password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$url = $_POST['url'];
	$method = $_POST['method'];
	$data = $_POST['data'];

	// Insert request into the database
	$stmt = $conn->prepare("INSERT INTO api_requests (url, method, data) VALUES (?, ?, ?)");
	$stmt->bind_param("sss", $url, $method, $data);
	$stmt->execute();
	$stmt->close();
}

// Fetch all requests
$result = $conn->query("SELECT * FROM api_requests");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>API Request Builder</title>
</head>
<body>
	<h1>API Request Builder</h1>
	<form method="POST">
    	<input type="text" name="url" placeholder="API URL" required><br>
    	<select name="method" required>
        	<option value="GET">GET</option>
        	<option value="POST">POST</option>
        	<option value="PUT">PUT</option>
        	<option value="DELETE">DELETE</option>
    	</select><br>
    	<textarea name="data" placeholder="Data (JSON format)"></textarea><br>
    	<button type="submit">Save Request</button>
	</form>

	<h2>Saved Requests</h2>
	<table border="1">
    	<tr>
        	<th>ID</th>
        	<th>URL</th>
        	<th>Method</th>
        	<th>Data</th>
    	</tr>
    	<?php while ($row = $result->fetch_assoc()): ?>
    	<tr>
        	<td><?php echo $row['TransactionID']; ?></td>
        	<td><?php echo $row['url']; ?></td>
        	<td><?php echo $row['method']; ?></td>
        	<td><?php echo $row['data']; ?></td>
    	</tr>
    	<?php endwhile; ?>
	</table>

</body>
</html>

<?php
$conn->close();
?>
