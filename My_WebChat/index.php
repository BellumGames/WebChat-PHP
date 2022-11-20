<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Main Page</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "sidebar.php";?>
	<div>
        <div class="content">
            <header>
                <h1>Welcome to the <?php include "header.php"?></h1>
            </header>

            <p>This is Webchat!</p>

            <?php include "footer.php";?>
        </div>
	</div>
</body>
</html>