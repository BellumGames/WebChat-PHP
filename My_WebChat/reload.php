<?php session_start(); ?>

<?php
	include "action_conn.php";
	$firstname = $_SESSION['firstname'];
	$lastname = $_SESSION['lastname'];
	$e_mail = $_SESSION['e_mail'];
	$password = $_SESSION['password'];
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
	mysqli_close($conn);
?>