<?php
require_once "init.php";
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>   
    <title>Consolidev | Home</title>
    
    <!-- icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        .btn {
            padding: 10px 20px;
            display: inline-block;
            margin: 10px 0;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .star {
            cursor: pointer;
            color: gray; /* default to empty star color */
            margin-left: 10px;
            font-size: 20px;
        }

        .star.checked {
            color: gold; /* filled star color */
        }

        /* spacing between links and stars */
        .tools-list {
            margin: 20px auto;
            text-align: center;
        }

        .tools-list a {
            display: inline-block;
            margin: 10px 15px;
            text-decoration: none;
        }
    </style>

</head>
<body>

<h1>Welcome back!</h1>

<div class="tools-list">
    <div>
        <a href="base64.php" class="btn">Base 64</a>
        <span class="fa fa-star star"></span>
    </div>
    <div>
        <a href="hashing.php" class="btn">Hashing</a>
        <span class="fa fa-star star"></span>
    </div>
    <div>
        <a href="caseconvertor.php" class="btn">Case Convertor</a>
        <span class="fa fa-star star"></span>
    </div>
    <div>
        <a href="differencechecker.php" class="btn">Difference Checker</a>
        <span class="fa fa-star star"></span>
    </div>
    <div>
        <a href="duplicates.php" class="btn">Duplicate Checker</a>
        <span class="fa fa-star star"></span>
    </div>
    <div>
        <a href="JWT.php" class="btn">JWT Decode</a>
        <span class="fa fa-star star"></span>
    </div>
    <div>
        <a href="paragraphtooneline.php" class="btn">Paragraph to One Line Convertor</a>
        <span class="fa fa-star star"></span>
    </div>
</div>

<script>
    // Adding an event listener for all the stars
    document.querySelectorAll('.star').forEach((star, index) => {
        // if the user has favorited the tool when the page loads
        if (localStorage.getItem(`tool_${index+1}_favorite`) === 'true') {
            star.classList.add('checked');  // fill the star in
        }

        // click event to toggle the favorite status
        star.addEventListener('click', function() {
            // toggles filled/empty star class
            star.classList.toggle('checked');

            // local storage to remember the favorite status
            localStorage.setItem(`tool_${index+1}_favorite`, star.classList.contains('checked') ? 'true' : 'false');
            
            // AJAX request to update the favorite status in the database
            var toolId = index + 1; // tool ID matches the index (you can modify this logic)
            var isFavorite = star.classList.contains('checked') ? 1 : 0;

            // AJAX request to update the favorite status in the database
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'favorites.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);  // success or failure handling
                }
            };
            xhr.send('tool_id=' + toolId + '&is_favorite=' + isFavorite);
        });
    });
</script>

</body>
</html>