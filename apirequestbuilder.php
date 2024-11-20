<?php
require_once 'init.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $endpoint = $_POST['endpoint'];
    $method = $_POST['method'];
    $headersInput = $_POST['headers'];
    $bodyInput = $_POST['body'];

    $headers = [];
    if ($headersInput) {
        $headers = json_decode($headersInput, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $headers = parseHeaders($headersInput); // if not valid JSON, treat as key-value pairs
        }
    }

    $body = null;
    if ($bodyInput) {
        $body = json_decode($bodyInput, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $body = json_encode($body); // making sure body is a valid JSON string
        } else {
            // form data or plain text body (for POST/PUT with form data)
            parse_str($bodyInput, $body);
        }
    }

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $endpoint);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    if (($method == 'POST' || $method == 'PUT') && $body) {
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
    }

    if (!empty($headers)) {
        $formattedHeaders = [];
        foreach ($headers as $key => $value) {
            $formattedHeaders[] = "$key: $value";
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $formattedHeaders);
    }

    // SSL verification
    curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . '/cacert.pem'); // Adjust path if needed

    $response = curl_exec($curl);

    if ($response === false) {
        echo 'Curl error: ' . curl_error($curl);
    } else {
        echo 'Response: ' . $response;
    }

    curl_close($curl);


    // function to parse headers as key-value pairs (non-JSON)
    function parseHeaders($input) {
        $headers = [];
        $lines = explode("\n", $input);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line) {
                list($key, $value) = explode(":", $line, 2);
                $headers[trim($key)] = trim($value);
            }
        }
        return $headers;
    }   

    try {
        global $connect;
        $sql = "INSERT INTO api_requests (username, endpoint, method, headers, body, date)
            VALUES(:username, :endpoint, :method, :headers, :body, CURRENT_TIMESTAMP)";

        $stmt = $connect->prepare($sql);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":endpoint", $endpoint);
        $stmt->bindParam(":method", $method);
        $stmt->bindParam(":headers", $headers);
        $stmt->bindParam(":body", $body);

        $stmt->execute();
        } catch (exception $e) {
        $display = "Error: " . $e->getMessage();
    }
}
?>

<html>
    <body>
        <h1>API Request Builder</h1>
        <form method="POST" action="apirequestbuilder.php">
            <label for="endpoint">API Endpoint:</label>
            <input type="text" name="endpoint" required><br>
            
            <label for="method">HTTP Method:</label>
            <select name="method" required>
                <option value="GET">GET</option>
                <option value="POST">POST</option>
                <option value="PUT">PUT</option>
                <option value="DELETE">DELETE</option>
            </select><br>

            <label for="headers">Headers (JSON/Key-Value format):</label>
            <textarea name="headers" placeholder='{"Content-Type": "application/json", "Authorization": "Bearer YOUR_TOKEN"}'></textarea><br>

            <label for="body">Body (JSON/Form-Data, applicable for POST/PUT):</label>
            <textarea name="body" placeholder='{"key1": "value1", "key2": "value2"}'></textarea><br>

            <input type="submit" value="Send Request">
        </form>
    </body>
</html>
