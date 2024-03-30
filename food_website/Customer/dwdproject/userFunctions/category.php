<?php 

include "../database/connect.php";
function getCategories()
{
    global $connection;
    $query = "select * from categories";
    $statement = mysqli_query($connection,$query);
    $categories = mysqli_fetch_all($statement);
    // var_dump($categories);
    // die();
    return $categories;
}


?>