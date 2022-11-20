<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>WebChat</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php include "sidebar.php";?>
	<div>
        <div class="content">
            <header>
                <h1><?php include "header.php"?></h1>
            </header>

			<?php
				if(!empty($_SESSION))
				{
					include "action_conn.php";
					$firstname = $_SESSION['firstname'];
					$lastname = $_SESSION['lastname'];
					$e_mail = $_SESSION['e_mail'];
					$password = $_SESSION['password'];
				
					echo "<div id=\"wrapper\">";
					echo "<div id=\"menu\">";
					echo "<p class=\"welcome\">Welcome ".$firstname." ".$lastname."!</p>";
					echo "<p class=\"logout\"><a id=\"exit\" href=\"action_log_out.php\">Log out</a></p>";
					echo "</div>";
				
					echo "<div id=\"chatbox\">";
					date_default_timezone_set('Europe/Bucharest'); 
					$time = date("Y-m-d H:i:s");
					$sql = 'SELECT E_mail, Message, Date_Time FROM messenger ORDER BY Date_Time ASC';
				
					if(!empty($_POST))
					{
						$new_message = $_POST["message"];
						$new_message = htmlentities($new_message);
						$insert = mysqli_query($conn, 'INSERT INTO messenger (E_mail, Message, Date_Time) VALUES ("'.$e_mail.'","'.$new_message.'","'.$time.'")');
				
						$query = mysqli_query($conn, $sql);
						while($data = mysqli_fetch_array($query))
						{
							$curr_email = $data['E_mail'];
							$curr_message = $data['Message'];
							$curr_time = $data['Date_Time'];
							$curr_time = "(".substr($curr_time, 11, 5).")";
				
							$check_email = mysqli_query($conn, 'SELECT Firstname, Lastname FROM user WHERE E_mail="'.$curr_email.'"');
							$check_admin = mysqli_query($conn, 'SELECT Firstname, Lastname FROM admin WHERE E_mail="'.$curr_email.'"');
				
							while($row = mysqli_fetch_assoc($check_admin)) 
							{
								$curr_firstname = $row['Firstname'];
								$curr_lastname = $row['Lastname'];
				
								echo "<p class=\"admin\">";
								echo $curr_firstname." ".$curr_lastname." ".$curr_time.": ".$curr_message;
								echo "</p>";
							}
							while($row = mysqli_fetch_assoc($check_email)) 
							{
								$curr_firstname = $row['Firstname'];
								$curr_lastname = $row['Lastname'];
								
								echo "<p>";
								echo $curr_firstname." ".$curr_lastname." ".$curr_time.": ".$curr_message;
								echo "</p>";
							}
						}
					}
					else
					{
						$query = mysqli_query($conn, $sql);
						while($data = mysqli_fetch_array($query))
						{
							$curr_email = $data['E_mail'];
							$curr_message = $data['Message'];
							$curr_time = $data['Date_Time'];
							$curr_time = "(".substr($curr_time, 11, 5).")";
				
							$check_email = mysqli_query($conn, 'SELECT Firstname, Lastname FROM user WHERE E_mail="'.$curr_email.'"');
							$check_admin = mysqli_query($conn, 'SELECT Firstname, Lastname FROM admin WHERE E_mail="'.$curr_email.'"');
				
							while($row = mysqli_fetch_assoc($check_admin)) 
							{
								$curr_firstname = $row['Firstname'];
								$curr_lastname = $row['Lastname'];
				
								echo "<p class=\"admin\">";
								echo $curr_firstname." ".$curr_lastname." ".$curr_time.": ".$curr_message;
								echo "</p>";
							}
							while($row = mysqli_fetch_assoc($check_email)) 
							{
								$curr_firstname = $row['Firstname'];
								$curr_lastname = $row['Lastname'];
								
								echo "<p>";
								echo $curr_firstname." ".$curr_lastname." ".$curr_time.": ".$curr_message;
								echo "</p>";
							}
						}
					}
					echo "</div>";

					echo "<form class=\"chat\" name=\"message\" method=\"post\" action=\"chat.php\">";
						echo "<input id=\"usermsg\" type=\"text\" name=\"message\" required>";
						echo "<input id=\"submitmsg\" type=\"submit\" value=\"Send\">";
					echo "</form>";
					echo "</div>";
				
					$result = mysqli_query($conn, 'SELECT E_mail FROM admin WHERE E_mail="'.$e_mail.'"');
					if(mysqli_num_rows($result) > 0)
					{
						echo "<p class=\"admin\">";
						echo "<a href=\"action_clear_message.php\">Clear chat!</a>";
						echo "</p>";
					}
					mysqli_close($conn);

					echo 
					"<script
						type=\"text/javascript\"
						src=\"https://code.jquery.com/jquery-3.6.0.js\"
						integrity=\"sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=\"
						crossorigin=\"anonymous\">
					</script>";
					echo 
					"<script>
						$(document).ready( function() {
							$('#chatbox').load('reload.php');
							refresh();
						});

						function refresh()
						{
							setTimeout( function() 
							{
								$('#chatbox').load('reload.php');
								refresh();
							},1000);
						}
					</script>";
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