<?php
require_once "init.php";
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

$username = $_SESSION['username'];
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

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const stars = document.querySelectorAll(".star");

                stars.forEach(star => {
                    star.addEventListener("click", function () {
                        star.classList.toggle("checked");

                        // Update hidden input with selected tools
                        let favorites = Array.from(document.querySelectorAll(".star.checked"))
                            .map(star => star.getAttribute("value"))
                            .join(",");
                        document.getElementById("favorites").value = favorites;
                    });
                });
            });
        </script>
    </head>
    <body>

    <h1>Manage Favorites</h1>

    <form method="post" action="updatefavorites.php">
        <div class="tools-list">
            <div>
                <a href="base64.php" class="btn">Base 64</a>
                <span class="fa fa-star star" value="Base64"></span>
            </div>
            <div>
                <a href="caseconvertor.php" class="btn">Case Converter</a>
                <span class="fa fa-star star" value="CaseConverter"></span>
            </div>
            <div>
                <a href="differencechecker.php" class="btn">Difference Checker</a>
                <span class="fa fa-star star" value="DifferenceChecker"></span>
            </div>
            <div>
                <a href="duplicates.php" class="btn">Duplicate Checker</a>
                <span class="fa fa-star star" value="DuplicateChecker"></span>
            </div>
            <div>
                <a href="hashing.php" class="btn">Hashing</a>
                <span class="fa fa-star star" value="Hashing"></span>
            </div>
            <div>
                <a href="Json.php" class="btn">JSON Validator</a>
                <span class="fa fa-star star" value="JSONValidator"></span>
            </div>
            <div>
                <a href="JWT.php" class="btn">JWT Decoder</a>
                <span class="fa fa-star star" value="JWTDecoder"></span>
            </div>
            <div>
                <a href="duplicates.php" class="btn">Markdown To Html Converter</a>
                <span class="fa fa-star star" value="MarkdownToHtmlConverter"></span>
            </div>
            <div>
                <a href="paragraphtooneline.php" class="btn">Paragraph to One Line Converter</a>
                <span class="fa fa-star star" value="ParagraphtoOneLineConverter"></span>
            </div>
            <div>
                <a href="timestampconverter.php" class="btn">Time Stamp Converter</a>
                <span class="fa fa-star star" value="TimeStampConverter"></span>
            </div>

            <!-- Hidden input for starred tools -->
            <input type="hidden" name="favorites" id="favorites" value="">

            <button type="submit" style="background-color: #c7aa17" class="btn">Update Favorites</button>
        </div>
    </form>

    </body>
    </html>
<?php
