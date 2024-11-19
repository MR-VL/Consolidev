<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consolidev | Home</title>
	<link rel="stylesheet" href="CSS/styles.css">
	<link rel="stylesheet" href="CSS/index.css">
	<script src="https://kit.fontawesome.com/d0af7889fc.js" crossorigin="anonymous"></script>
</head>
<body>

<!--Include Header-->
<?php include 'header.php'; ?>

<!--Main Content-->
<main>
	<!-- Hero Section -->
	<section class="hero">
		<div class="hero-content">
			<h1>Welcome to consoliDev</h1>
			<p>Your ultimate dev toolkit. Log in or register to get started.</p>
			<div class ="buttons">
				<a href="login.php" class="btn login-btn">Login</a>
				<a href="register.php" class="btn register-btn">Register</a>
			</div>
		</div>
		<div class="hero-image">
			<img src="pics/man-1839500_1280.jpg" alt="Man typing on computer">
		</div>
	</section>
	
	<!--Tools Section-->
	<section class="tools">
		<h2> Explore Our Tools</h2>
		<div class="tool-cards">
			<div class="tool-card">
				<i class="fa-solid fa-unlock-keyhole"></i>
				<h3>Base 64 Encrypt/Decrypt</h3>
				<p>Quickly encode or decode text using Base64 encoding.</p>
			</div>
			<div class="tool-card">
				<i class="fa-solid fa-key"></i>
				<h3>JWT Decode</h3>
				<p>Decode JSON Web Tokens to view payload data.</p>
			</div>
			<div class="tool-card">
				<i class="fa-solid fa-i-cursor"></i>
				<h3>Paragraph to One Line Converter</h3>
				<p>Convert multi-line paragraphs into a single line.</p>
			</div>
			<div class="tool-card">
				<i class="fa-solid fa-arrows-rotate"></i>
				<h3>Case Converter</h3>
				<p>Convert text between uppercase, lowercase, and more.</p>
			</div>
			<div class="tool-card">
				<i class="fa-solid fa-magnifying-glass"></i>
				<h3>Duplicate Finder</h3>
				<p>Find and highlight duplicate lines or entries.</p>
			</div>
			<div class="tool-card">
				<i class="fa-solid fa-check-double"></i>
				<h3>Difference Checker</h3>
				<p>Compare two texts and highlight differences.</p>
			</div>
			<div class="tool-card">
				<i class="fa-solid fa-terminal"></i>
				<h3>JSON Tools</h3>
				<p>Validate, format, and edit JSON data easily.</p>
			</div>
			<div class="tool-card">
				<i class="fa-solid fa-hashtag"></i>
				<h3>Hashing Tools</h3>
				<p>Hash data using multiple algorithms for secure processing.</p>
			</div>
            <div class="tool-card">
                <i class="fa-solid fa-code"></i>
                <h3>Markdown to HTML</h3>
                <p>Convert Markdown text into clean, structured HTML.</p>
            </div>
			<div class="tool-card">
				<i class="fa-solid fa-clock"></i>
				<h3>Timestamp Converter</h3>
				<p>Quickly and easily convert date and time.</p>
			</div>
		</div>
	</section>
</main>

<footer>
    <p>&copy; <span id="2024"></span> consoliDev. All Rights Reserved.</p>
</footer>

</body>
</html>
