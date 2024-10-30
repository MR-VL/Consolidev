<?php
/*-------------------------------------------------------------------------------------------*/
/*You should have everything between these 2 bars the same regardless of page!!!!*/
//initialize connection to database
require_once 'init.php';

//session management + user credentials
session_start();

//if user not logged in redirect to login screen
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

//store their username to be used later
$username = $_SESSION['username'];
/*--------------------------------------------------------------------------------------------*/


//You need this IF statement and put all your stuff inside it
//it basically listens for when the user clicks the submit button to begin doing stuff
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //there is a input textbox in the html with the id of base64 this grabs the info user entered
    $input = filter_input(INPUT_POST, "base64", FILTER_SANITIZE_SPECIAL_CHARS);

    //You need an if like this to determine that the user actually entered something and not submitted a blank
    //the blank should be handled by frontend but this is safety net
    if (!empty($input)) {

        /*-----------------------------------------------------------------------------------------------*/
        /*The stuff between these 2 bars will differ from page to page, this is where the main logic for your page
        will go. You need to write whatever your code does here

        I will describe mines so you get a general idea*/

        //There are 2 radio buttons in the html with the same name, if you want the user to select only one your need to
        //give them the same name
        //But basically this gets the ID from the radio button that is selected after submission
        $type = $_POST["ans"];

        //determines which radio button was selected based off ID value
        if ($type == "encode") {
            //performs the required stuff, mines is just php function to encode user input and store in variable
            $opposite = base64_encode($input);
        } else {
            //if user clicked the decode it just uses php function to decode and store it in variable
            $opposite = base64_decode($input);

        }

        //variable to store the stuff to be displayed later, there's multiple ways of doing this
        //I just found this way seemed easier and more consistent during runtime.
        $display = "<div style='color: #00008B'><h2>Decoded Base 64:</h2><br> <h2>$opposite</h2><br>";

        /*------------------------------------------------------------------------------------------------*/


        try {
            /****************************************************************************************************/
            /*You will need this and copy it the way you see it here and just change the values*/

            //Type this EXACTLY as is!!!!, this grabs the connect variable from init.php for database connection.
            global $connect;

            //You should not have anything such as localhost or root on any of your pages it is all handled on the init.php
            //and database.php to prevent us from writing the same thing a billion times


            //SQL code for insertion CHANG TO YOUR CODE,
            //The INSERT INTO STUFF is the DATABASE variables
            // the VALUES are declared below using stmt!
            $sql = "INSERT INTO base64 (username, type, original, opposite, date)
                VALUES(:username, :type, :input, :opposite, CURRENT_TIMESTAMP)";


            //Just copy this line as is, prepares sql
            $stmt = $connect->prepare($sql);


            //Bind parameters for VALUES above, to your codes VARIABLES

            // :username is temp for insertion binding and $username is you codes variable
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":type", $type);
            $stmt->bindParam(":opposite", $opposite);
            $stmt->bindParam(":input", $input);


            $stmt->execute();
            /****************************************************************************************************/
        } catch (exception $e) {
            $display = "Error: " . $e->getMessage();

        }
    } // Something really bad happened to either the database connection or the post method, ABORTa
    else {
        $display = "<div style='color: #00008B'><h2>Fatal Error.. Please retry</h2></div>";
    }

}
?>

<!-- This is html I dont feel like I need to explain a lot-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Consolidev | Base 64</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            display: flex;
            flex-direction: row;
            gap: 20px;
            max-width: 80vw;
        }
    </style>
</head>
<body>

<!-- For not you might want to use my classes as a general template, but Lilly and Katelyn yall are in charge of styling
There is also a styles.css file with more styles that are general throughout most of the pages I have done-->
<div class="container">

    <div class="form">
        <form action="base64.php" method="post">
            <label for="base64">Enter a value and choose to encode or decode Base 64</label>
            <br>
            <div style="display: inline-flex">
                <input type="radio" id="encode" name="ans" value="encode" required>
                <label for="encode">Encode</label>
            </div>
            <br>
            <div style="display: inline-flex; margin-top: 3vh">
                <input type="radio" id="decode" name="ans" value="decode" required>
                <label for="decode">Decode</label>
            </div>
            <input style="height: 20vh" type="text" id="base64" name="base64" placeholder="Type here" required><br><br>
            <input type="submit" value="Convert">
        </form>
    </div>


    <div class="form" style="word-wrap: break-word">

        <a href="base64history.php">
            <button class="btn">View History</button>
        </a>

        <?php
        //This checks to see if the display is empty or not, and if there is something to be displayed
        //it will display it, It is much more reliable to do it this way!!
        if (!empty($display)) {
            echo $display;
        }
        ?>
    </div>
</div>
</body>
</html>
