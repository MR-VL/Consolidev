<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consolidev | Home</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #f8f9fa;
            padding: 1vh 2vw;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-left {
            list-style: none;
            display: flex;
            gap: 2vw;
        }

        .navbar-left a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .navbar-right button {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 0.5vh;
            padding: 1.5vh 3vw;
            font-size: 0.75rem;
            cursor: pointer;
            margin-left: 2vw;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .navbar-right button:hover {
            background-color: #0056b3;
            box-shadow: 0 0 0.5vh rgba(0, 0, 0, 0.2);
        }

        main {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2vw;
        }

        .main-content {
            text-align: center;
        }

        .main-content img {
            max-width: 100%;
            height: auto;
            border-radius: 1vh;
        }

        .main-content p {
            margin-top: 1vh;
            font-size: 1.2rem;
            color: #333;
        }

        footer {
            background-color: #f8f9fa;
            padding: 1vh 2vw;
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            align-items: center;
        }

        .footer-left {
            list-style: none;
            display: flex;
            gap: 2vw;
        }

        .footer-left a {
            text-decoration: none;
            color: #007bff;
        }

        .footer-right p {
            margin: 0;
            font-size: 1rem;
            color: #333;
        }
    </style>
</head>
<body>

<header>
    <nav>
        <ul class="navbar-left">
            <li><a href="#">Item 1</a></li>
            <li><a href="#">Item 2</a></li>
            <li><a href="#">Item 3</a></li>
        </ul>

        <div class="navbar-right">
            <a href="login.php">
                <button>Login</button>
            </a>
            <a href="register.php">
                <button>Sign Up</button>
            </a>
        </div>
    </nav>
</header>

<main>
    <div class="main-content">
        <img src="https://via.placeholder.com/400" alt="Placeholder Image">
        <p>This is some descriptive text about the image.</p>
    </div>
</main>

<footer>
    <div class="footer-left">
        <a href="#">Link 1</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>
    </div>
    <div class="footer-right">
        <p>Footer text</p>
    </div>
</footer>

</body>
</html>
