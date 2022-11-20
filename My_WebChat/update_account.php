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
                <h1>Update your account here:</h1>
            </header>

			<?php
			if(!empty($_SESSION))
			{
				include "action_conn.php";

				$old_firstname = $_SESSION['firstname'];
				$old_lastname = $_SESSION['lastname'];
				$old_email = $_SESSION['e_mail'];
				$old_password = $_SESSION['password'];

				$check_admin = mysqli_query($conn, 'SELECT E_mail FROM admin WHERE E_mail="'.$old_email.'"');

				if(mysqli_num_rows($check_admin) > 0)
				{
					$query = mysqli_query($conn,'SELECT * FROM user');

					if(!empty($_POST))
					{
						$curr_email = $_POST['e_mail'];
						$curr_email = htmlentities($curr_email);

						$result = mysqli_query($conn,'SELECT * FROM user WHERE E_mail="'.$curr_email.'"');
						while($row = mysqli_fetch_assoc($result)) 
						{
							$curr_id = $row["ID"];
							$curr_firstname = $row["Firstname"];
							$curr_lastname = $row["Lastname"];
							$curr_password = $row["Password"];
						}

						echo "<form method=\"post\" action=\"action_update_account.php\" autocomplete=\"on\">";
						echo '<label>The old ID is: "'.$curr_id.'" the new one will be:</label>';
						echo "<br>";
						echo "<input type=\"text\" name=\"id\" required>";
						echo "<br>";

						echo '<label>The old Firstname is: "'.$curr_firstname.'" the new one will be:</label>';
						echo "<br>";
						echo "<input type=\"text\" name=\"firstname\" required>";
						echo "<br>";

						echo '<label>The old Lastname is: "'.$curr_lastname.'" the new one will be:</label>';
						echo "<br>";
						echo "<input type=\"text\" name=\"lastname\" required>";
						echo "<br>";

						echo '<label>The old E-mail is: "'.$curr_email.'" the new one will be:</label>';
						echo "<br>";
						echo "<input type=\"text\" name=\"e_mail\" required>";
						echo "<br>";

						echo '<label>The old Password is: "'.$curr_password.'" the new one will be:</label>';
						echo "<br>";
						echo "<input type=\"password\" name=\"password\" autocomplete=\"off\" required>";
						echo "<br>";

						echo "<input type=\"submit\" value=\"Update the account\">";
						echo "<br>";
						echo "</form>";
					}
					else
					{
						echo "<form method=\"post\" action=\"update_account.php\">";
						echo "<label for=\"e_mail\">E-mail: </label>";
						echo "<br>";
						echo "<select name=\"e_mail\" id=\"e_mail\" required>";
						echo "<option value=\"----\">----</option>";
						while($data = mysqli_fetch_array($query))
						{
							$i = $data['E_mail'];
							echo "<option value=\"".$i."\">".$i."</option>";
						}
						echo "</select>";
						echo "<input type=\"submit\" value=\"Update the account\">";
						echo "<br>";
						echo "</form>";
					}
				}
				else
				{		
					echo 
					"<form method=\"post\" action=\"update_account.php\" autocomplete=\"on\">
					<label>Firstname:</label>  
					<br>
					<input type=\"text\" name=\"firstname\" required>
					<br>

					<label>Lastname:</label>
					<br>
					<input type=\"text\" name=\"lastname\" required>
					<br>

					<label>E-mail: </label>
					<br>
					<input type=\"text\" name=\"e_mail\" required>
					<br>

					<label>Password: </label>
					<br>
					<input type=\"password\" name=\"password\" autocomplete=\"off\" required>
					<br>

					<input type=\"submit\" value=\"Update my account\">
					<br>
					</form>"
					;

					if(!empty($_POST))
					{
						$firstname = $_POST['firstname'];
						$lastname = $_POST['lastname'];
						$e_mail = $_POST['e_mail'];
						$password = $_POST['password'];

						$firstname = htmlentities($firstname);
						$lastname = htmlentities($lastname);
						$e_mail = htmlentities($e_mail);
						$password = htmlentities($password);
						
						$look_for_id = mysqli_query($conn, 'SELECT ID FROM user WHERE E_mail="'.$old_email.'" AND Password="'.$old_password.'"');
						
						while($row = mysqli_fetch_assoc($look_for_id)) 
						{
							$curr_id = $row["ID"];
						}

						$check_email = mysqli_query($conn, 'SELECT E_mail FROM user WHERE E_mail="'.$e_mail.'"');//it checks if the e-mail already exist in DB
						$check_admin = mysqli_query($conn, 'SELECT E_mail FROM admin WHERE E_mail="'.$e_mail.'"');//same but for admin

						if((mysqli_num_rows($check_email) || mysqli_num_rows($check_admin)) > 0)
						{
							echo "<p class=\"warning\">";
							echo "*You can't use this e-mail, it already exist in database!";
							echo "</p>";
						}
						else
						{
							mysqli_query($conn, 'UPDATE user SET ID="'.$curr_id.'",Firstname="'.$firstname.'", Lastname="'.$lastname.'", E_mail="'.$e_mail.'", Password="'.$password.'" WHERE ID="'.$curr_id.'"');

							unset($_SESSION['firstname']);
							unset($_SESSION['lastname']);
							unset($_SESSION['e_mail']);
							unset($_SESSION['password']);

							$_SESSION['firstname'] = $firstname;
							$_SESSION['lastname'] = $lastname;
							$_SESSION['e_mail'] = $e_mail;
							$_SESSION['password'] = $password;
							
							echo "<p>*Your account has been successfully updated</p>";
						}
					}
					else
					{
						echo "<p>*Here you can update your account!";
					}
				}
				mysqli_close($conn);
			}
            else
            {
				include "reddirect_log_in.php";
            }
			?>

            <?php include "footer.php";?>
        </div>
	</div>
</body>
</html>