<?php
    session_start();
    include "action_conn.php";
    $e_mail = $_SESSION['e_mail'];
    $password = $_SESSION['password'];
                    
    $check_email_password = mysqli_query($conn, 'SELECT E_mail, Password FROM user WHERE E_mail="'.$e_mail.'" AND Password="'.$password.'"');//it checks if the e-mail and password exist in DB
    if(mysqli_num_rows($check_email_password) > 0)
    {
        $result = mysqli_query($conn, 'DELETE FROM user WHERE E_mail="'.$e_mail.'" AND Password="'.$password.'"');
        echo "<p>";
        echo "The account has been successfully deleted!";
        echo "</p>";
    }
    else
    {
        echo "<p class=\"warning\">";
        echo "*The entered e-mail or password is wrong! Please try again!";
        echo "</p>";
    }
    mysqli_close($conn);
    unset($_SESSION['firstname']);
    unset($_SESSION['lastname']);
    unset($_SESSION['e_mail']);
    unset($_SESSION['password']);
    header("Location:index.php");
?>