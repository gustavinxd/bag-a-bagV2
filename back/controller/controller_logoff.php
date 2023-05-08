<?php 
    session_start();
    unset($_SESSION['id_usuario']);
    echo "<script>location.href='./login.php';</script>";
?>