<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add to Cart</title>
</head>
<?php
    session_start();
    if(empty($_SESSION['Customer'])){
	    header('location:login.php');
    }else{
	    $id=$_GET['id'];
	    $_SESSION['cart'][$id]++;
	    header("location:cart.php");
    }
?>
<body>
    
</body>
</html>