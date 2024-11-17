<?php
// Initialize connection and session check
require_once 'init.php';
session_start();

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
            $formattedInput = $date->format('m-d-Y H:i:s'); // Original input with seconds
            $date->setTimezone(new DateTimeZone($toTimezone));
            $formattedOutput = $date->format('m-d-Y H:i:s'); // Converted output

            $output .= "<h2>Conversion Result:</h2>";
            $output .= "<p><strong>Original Date Time:</strong><br/> $formattedInput in $fromTimezone</p>";
            $output .= "<p><strong>Converted Date Time:</strong><br/> $formattedOutput in $toTimezone</p>";
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
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="CSS/styles.css" />
    <link rel="stylesheet" href="CSS/timestampconverter.css" />
    <script src="https://kit.fontawesome.com/d0af7889fc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
</head>

<body>
<?php include('header.php'); ?>

<main class="content-wrapper">
    <div class="title-container">
        <i class="fa-solid fa-clock title-icon"></i>
        <h1 class="page-title">Timestamp Converter</h1>
    </div>

    <div class="container">
        <!-- Date and Time Conversion Form -->
        <form action="timestampconverter.php" method="post">
            <!-- Date -->
            <label for="dateInput">Enter Date (MM/DD/YYYY):</label><br>
            <input type="date" id="dateInput" name="dateInput" required><br><br>

            <!-- Time -->
            <label for="timeInput">Enter Time (HH:mm):</label><br>
            <input type="time" id="timeInput" name="timeInput" required><br><br>

            <!-- From Timezone -->
            <label for="fromTimezone">From Timezone:</label><br>
            <select id="fromTimezone" name="fromTimezone" class="timezone-select" required>
                <?php
                foreach ($timezones as $timezone) {
                    $offset = getTimezoneOffset($timezone);
                    echo "<option value=\"$timezone\">$timezone (UTC $offset)</option>";
                }
                ?>
            </select><br><br>

            <!-- To Timezone -->
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

        <!-- Result Section -->
        <div class="result-section">
            <?php echo $output; ?>
        </div>
    </div>

    <!-- Include jQuery and Select2 JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Apply Select2 to each timezone dropdown
            $('.timezone-select').select2({
                placeholder: 'Select a timezone',
                allowClear: true
            });
        });
    </script>
</main>

<footer>
    <p>&copy; <span id="2024"></span> consoliDev. All Rights Reserved.</p>
</footer>
</body>
</html>
