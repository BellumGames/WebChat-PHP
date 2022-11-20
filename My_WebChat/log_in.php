<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Log in</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php include "sidebar.php";?>
	<div>
        <div class="content">
            <header>
                <h1>Log in here:</h1>
            </header>

            <form method="post" action="log_in.php" autocomplete="on">
          		<label>E-mail: </label>
          		<br>
				<input type="text" name="e_mail" required>
				<br>

          		<label>Password: </label>
			  	<br>
			  	<input type="password" name="password" autocomplete="off" required>
				<br>

				<input type="submit" value="Log in">
				<br>
    		</form>

			<?php
			if(!empty($_POST))
			{
				$admin_email = 0;
				$admin_password = 0;
				include "action_conn.php";
				$e_mail = $_POST['e_mail'];
				$password = $_POST['password'];
	
				$e_mail = htmlentities($e_mail);
				$password = htmlentities($password);
				
				$check_admin = mysqli_query($conn, 'SELECT E_mail, Password FROM admin WHERE E_mail="'.$e_mail.'" AND Password="'.$password.'"');
				while($row = mysqli_fetch_assoc($check_admin))
				{
					$admin_email = $row['E_mail'];
					$admin_password = $row['Password'];
				}

				if(($admin_email == $e_mail) && ($admin_password == $password))
				{
					$check_email_password = mysqli_query($conn, 'SELECT E_mail, Password FROM admin WHERE E_mail="'.$e_mail.'" AND Password="'.$password.'"');//it checks if the e-mail and password exist in DB
					if(mysqli_num_rows($check_email_password) > 0)
					{
						$look_for_names = mysqli_query($conn, 'SELECT Firstname, Lastname FROM admin WHERE E_mail="'.$e_mail.'" AND Password="'.$password.'"');
						while($row = mysqli_fetch_assoc($look_for_names)) 
						{
							if(empty($_SESSION))
							{
								$_SESSION['firstname'] = $row["Firstname"];
								$_SESSION['lastname'] = $row["Lastname"];
								$_SESSION['e_mail'] = $e_mail;
								$_SESSION['password'] = $password;
							}
						}
						if(!empty($_SESSION))
						{
							echo "<p class=\"admin\">";
							echo "You are now logged in as ADMIN! ";
							echo "Press <a href=\"action_log_out.php\">here</a> to log out!";
							echo "</p>";
						}
						else
						{
							echo "<p class=\"warning\">";
							echo "You are not logged in, an error occurred!";
							echo "</p>";
						}
					}
					else
					{
						echo "<p class=\"warning\">";
						echo "The entered e-mail or password is wrong! Please try again!";
						echo "</p>";
					}
				}
				else
				{
					$check_email_password = mysqli_query($conn, 'SELECT E_mail, Password FROM user WHERE E_mail="'.$e_mail.'" AND Password="'.$password.'"');//it checks if the e-mail and password exist in DB
					if(mysqli_num_rows($check_email_password) > 0)
					{
						$look_for_names = mysqli_query($conn, 'SELECT Firstname, Lastname FROM user WHERE E_mail="'.$e_mail.'" AND Password="'.$password.'"');
						while($row = mysqli_fetch_assoc($look_for_names)) 
						{
							if(empty($_SESSION))
							{
								$_SESSION['firstname'] = $row["Firstname"];
								$_SESSION['lastname'] = $row["Lastname"];
								$_SESSION['e_mail'] = $e_mail;
								$_SESSION['password'] = $password;
							}
						}
						if(!empty($_SESSION))
						{
							echo "<p>";
							echo "You are now logged in! ";
							echo "Press <a href=\"action_log_out.php\">here</a> to log out!";
							echo "</p>";
						}
						else
						{
							echo "<p class=\"warning\">";
							echo "You are not logged in, an error occurred!";
							echo "</p>";
						}
					}
					else
					{
						echo "<p class=\"warning\">";
						echo "The entered e-mail or password is wrong! Please try again!";
						echo "</p>";
					}
				}
				mysqli_close($conn);
			}
			else 
			{
				if(!empty($_SESSION))
				{
					echo "<p>";
					echo "You are now logged in! What are you waiting for? ";
					echo "Press <a href=\"action_log_out.php\">here</a> to log out!";
					echo "</p>";
				}
				else 
				{
					echo "<p>*Here you can log in!";
				}
			}
			?>

			<?php include "footer.php";?>
        </div>
	</div>
</body>
</html>