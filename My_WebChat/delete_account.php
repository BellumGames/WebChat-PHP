<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Delete your account</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php include "sidebar.php";?>
	<div>
        <div class="content">
            <header>
                <h1>You can delete your account here:</h1>
            </header>

			<?php
			if(!empty($_SESSION))
			{
				$admin_email = 0;
				$admin_password = 0;
				include "action_conn.php";

				$query = mysqli_query($conn,'SELECT * FROM user');
				
				$e_mail = $_SESSION['e_mail'];
				$password = $_SESSION['password'];

				$check_admin = mysqli_query($conn, 'SELECT E_mail, Password FROM admin WHERE E_mail="'.$e_mail.'" AND Password="'.$password.'"');
				while($row = mysqli_fetch_assoc($check_admin))
				{
					$admin_email = $row['E_mail'];
					$admin_password = $row['Password'];
				}
				if(($admin_email == $e_mail) && ($admin_password == $password))
				{
					echo "<form method=\"post\" action=\"delete_account.php\">";
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
					echo "<input type=\"submit\" value=\"Delete the account\">";
					echo "<br>";
					echo "</form>";

					if(!empty($_POST))
					{
						$e_mail = $_POST['e_mail'];
						$e_mail = htmlentities($e_mail);

						$check_email_password = mysqli_query($conn, 'SELECT E_mail, Password FROM user WHERE E_mail="'.$e_mail.'"');//it checks if the e-mail exist in DB
						if(mysqli_num_rows($check_email_password) > 0)
						{
							$result = mysqli_query($conn, 'DELETE FROM user WHERE E_mail="'.$e_mail.'"');
							echo "<p>";
							echo "The account has been successfully deleted!";
							echo "</p>";
						}
						else
						{
							echo "<p class=\"warning\">";
							echo "*The entered e-mail is already deleted from database!";
							echo "</p>";
						}
					}
				}
				else
				{
					echo "<form method=\"post\" action=\"action_deletion.php\">";
					echo "<button type=\"submit\">Delete my account!</button>";
					echo "</form>";
					echo "<p>*Here you can delete your account!";
				}
				mysqli_close($conn);
			}
			else
			{
				include "reddirect_log_in.php";
			}
			?>

			<?php include 'footer.php';?>
        </div>
	</div>
</body>
</html>