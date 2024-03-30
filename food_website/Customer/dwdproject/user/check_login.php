<?php
    if(empty($_SESSION['customer_id'])){
	    header('location:login.php');
    }
?>