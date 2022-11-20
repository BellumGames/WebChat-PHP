<?php
    session_start();
    include "action_conn.php";
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $e_mail = $_POST['e_mail'];
    $password = $_POST['password'];

    mysqli_query($conn, 'UPDATE user SET ID="'.$id.'",Firstname="'.$firstname.'", Lastname="'.$lastname.'", E_mail="'.$e_mail.'", Password="'.$password.'" WHERE ID="'.$id.'"');

    mysqli_close($conn);
    header("Location:update_account.php");
?>