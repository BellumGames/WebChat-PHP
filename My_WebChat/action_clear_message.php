<?php
    session_start();
    include "action_conn.php";
    mysqli_query($conn, 'DELETE FROM messenger WHERE 1');
    mysqli_close($conn);
    header("Location:chat.php");
?>