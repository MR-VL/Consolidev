<?php
// Initialize connection and session check
require_once 'init.php';
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
$output = "";

// Retrieve all time zones with offsets for the dropdowns
$timezones = DateTimeZone::listIdentifiers();

function getTimezoneOffset($timezone) {
    $dateTime = new DateTime('now', new DateTimeZone($timezone));
    $offset = $dateTime->getOffset();
    $hours = floor($offset / 3600);
    $minutes = abs(($offset % 3600) / 60);
    return sprintf("%+03d:%02d", $hours, $minutes); // Format as "+hh:mm"
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputDate = filter_input(INPUT_POST, "dateInput", FILTER_SANITIZE_SPECIAL_CHARS);
    $inputTime = filter_input(INPUT_POST, "timeInput", FILTER_SANITIZE_SPECIAL_CHARS);
    $fromTimezone = filter_input(INPUT_POST, "fromTimezone", FILTER_SANITIZE_SPECIAL_CHARS);
    $toTimezone = filter_input(INPUT_POST, "toTimezone", FILTER_SANITIZE_SPECIAL_CHARS);

    if ($inputDate && $inputTime && $fromTimezone && $toTimezone) {
        $dateTimeString = "$inputDate $inputTime";

        try {
            $date = new DateTime($dateTimeString, new DateTimeZone($fromTimezone));
            $date->setTimezone(new DateTimeZone($toTimezone));

            $output .= "<h3>Converted Date and Time:</h3>";
            $output .= "<p>" . $date->format('Y-m-d H:i:s') . " ($toTimezone)</p>";
        } catch (Exception $e) {
            $output .= "<p>Error: " . $e->getMessage() . "</p>";
        }
    } else {
        $output .= "<p>Please fill in all fields correctly.</p>";
    }

    global $connect;
    $sql = "INSERT INTO timestampconverter (username, date) VALUES(:username, CURRENT_TIMESTAMP)";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>ConsoliDev | Timestamp Converter</title>
    <meta name="viewport" content="width=device-width, charset="utf-8"/>
    <link rel="stylesheet" href="styles.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <style>
        .container { max-width: 50vw; margin: auto; }
    </style>
</head>
<body>
<div class="container">
    <h1>Timestamp Converter</h1>

    <!-- Date and Time Conversion Form -->
    <form action="timestampconverter.php" method="post">
        <label for="dateInput">Enter Date (YYYY-MM-DD):</label><br>
        <input type="date" id="dateInput" name="dateInput" required><br><br>

        <label for="timeInput">Enter Time (HH:mm):</label><br>
        <input type="time" id="timeInput" name="timeInput" required><br><br>

        <label for="fromTimezone">From Timezone:</label><br>
        <select id="fromTimezone" name="fromTimezone" class="timezone-select" required>
            <?php
            foreach ($timezones as $timezone) {
                $offset = getTimezoneOffset($timezone);
                echo "<option value=\"$timezone\">$timezone (UTC $offset)</option>";
            }
            ?>
        </select><br><br>

        <label for="toTimezone">To Timezone:</label><br>
        <select id="toTimezone" name="toTimezone" class="timezone-select" required>
            <?php
            foreach ($timezones as $timezone) {
                $offset = getTimezoneOffset($timezone);
                echo "<option value=\"$timezone\">$timezone (UTC $offset)</option>";
            }
            ?>
        </select><br><br>

        <input type="submit" value="Convert Time">
    </form>

    <h2>Conversion Results</h2>
    <?php echo $output; ?>
</div>

<!-- jQuery and Select2 JavaScript (for searchable dropdown) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.timezone-select').select2({
            placeholder: 'Select a timezone',
            allowClear: true
        });
    });
</script>
</body>
</html>
