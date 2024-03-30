<?php 
    session_start();
    unset($_SESSION['Admin']);
    header('location:index.php');
?>