<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Create a new account</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "sidebar.php";?>
	<div>
        <div class="content">
            <header>
                <h1>Register here:</h1>
            </header>

			<form method="post" action="register_account.php" autocomplete="on">
            	<label>Firstname:</label>  
				<br>
				<input type="text" name="firstname" required>
          		<br>

            	<label>Lastname:</label>
          		<br>
				<input type="text" name="lastname" required>
				<br>

          		<label>E-mail: </label>
          		<br>
				<input type="text" name="e_mail" required>
				<br>

          		<label>Password: </label>
			  	<br>
			  	<input type="password" name="password" autocomplete="off" required>
				<br>

				<input type="submit" value="Register">
				<br>
    		</form>

			<?php
			if(!empty($_POST))
			{
				include "action_conn.php";
				$firstname = $_POST['firstname'];
				$lastname = $_POST['lastname'];
				$e_mail = $_POST['e_mail'];
				$password = $_POST['password'];

				$firstname = htmlentities($firstname);
				$lastname = htmlentities($lastname);
				$e_mail = htmlentities($e_mail);
				$password = htmlentities($password);
				
				$check_email = mysqli_query($conn, 'SELECT E_mail FROM user WHERE E_mail="'.$e_mail.'"');//it checks if the e-mail already exist in DB
				$check_admin = mysqli_query($conn, 'SELECT E_mail FROM admin WHERE E_mail="'.$e_mail.'"');//same but for admin

				if((mysqli_num_rows($check_email) || mysqli_num_rows($check_admin)) > 0)
				{
					echo "<p class=\"warning\">";
					echo "*The e-mail already exist in database";
					echo "</p>";
				}
				else
				{
					if(!(empty($firstname) || empty($lastname) || empty($e_mail) || empty($password)))
                	{
                    	echo "<p>";
				    	echo "Your Firstname is: ".$firstname."<br>";
				    	echo "Your Lastname is: ".$lastname."<br>";
				    	echo "Your E-mail is: ".$e_mail."<br>";
				    	echo "Your Password is: ".$password."<br>";
				    	echo "<br>";
				    	echo "Your account has been successfully created!<br>";
						echo "Press <a href=\"log_out.php\">here</a> to log out!";
				   		echo "</p>";
						$result = mysqli_query($conn, 'INSERT INTO user (Firstname, Lastname, E_mail, Password) VALUES ("'.$firstname.'","'.$lastname.'","'.$e_mail.'","'.$password.'")');//insert data in DB
                	}
					else
					{
						echo "<p class=\"warning\">*You have not filled all the fields with the required data or the data entered is insufficient, please try again to enter the data.</p>";
					}
					mysqli_close($conn);
				}
			}
            else
            {
                echo "<p>*Please remember your entered e-mail and password, you will need them for log-in process!</p>";
            }
			?>

            <?php include "footer.php";?>
        </div>
	</div>
</body>
</html>