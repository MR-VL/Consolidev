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

    if (!filter_var($endpoint, FILTER_VALIDATE_URL)) {
        die("Invalid API endpoint.");
    }

    $headers = [];
    if ($headersInput) {
        $headers = json_decode($headersInput, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $headers = parseHeaders($headersInput); // if not valid JSON, treat as key-value pairs
        }
    }

    $body = null;
    if ($bodyInput) {
        $decodedBody = json_decode($bodyInput, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $body = json_encode($decodedBody); // Ensure body is a valid JSON string
        } else {
            $body = $bodyInput; // Use as-is for plain text or form data
        }
    }

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $endpoint);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);


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
    curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . '/Libraries/cacert.pem'); // Adjust path if needed

    $response = curl_exec($curl);

    if ($response === false) {
        $error = curl_error($curl);
        echo 'cURL Error: ' . $error;
        curl_close($curl);
        exit();
    } else {
        // Decode the response
        $decodedResponse = json_decode($response, true);
    
        // Check if the response is valid JSON
        if (json_last_error() === JSON_ERROR_NONE) {
            // Convert the JSON response to a string and remove escaped slashes
            $jsonString = json_encode($decodedResponse, JSON_PRETTY_PRINT);
    
            // Replace escaped slashes (\/) with normal slashes (/)
            $jsonString = str_replace('\/', '/', $jsonString);
    
            // Output the cleaned-up JSON
            echo '<pre>' . $jsonString . '</pre>';
        } else {
            // If the response is not valid JSON, just print it as-is
            echo 'Response: ' . $response;
        }
    }
    
    

    curl_close($curl);

    try {
        global $connect;
        $sql = "INSERT INTO api_requests (username, date, url, method, headers, body)
        VALUES (:username, CURRENT_TIMESTAMP, :url, :method, :headers, :body)";

        $headersString = json_encode($headers);
        $bodyString = is_array($body) ? json_encode($body) : $body;
        
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":url", $endpoint);
        $stmt->bindParam(":method", $method);
        $stmt->bindParam(":headers", $headersString);
        $stmt->bindParam(":body", $bodyString);

        $stmt->execute();

    } catch (Exception $e) {
        $display = "Error: " . $e->getMessage();
    }
}

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
