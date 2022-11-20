<?php 
    session_start();
    unset($_SESSION["firstname"]);
    unset($_SESSION["lastname"]);
    unset($_SESSION["e_mail"]);
    unset($_SESSION["password"]);
    header("Location:index.php");
?>