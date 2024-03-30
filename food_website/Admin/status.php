<?php 
    include 'connect.php';
    // Check if 'cus_upd' is set in the URL parameters
    if(isset($_GET['cus_upd'])) {
        $id = $_GET['cus_upd'];
        $status = $_GET['status'];
        
        if($status == 1) {
            $query = "UPDATE order_lists SET status = 1, send_date = NOW() WHERE orderlist_id = '$id'";
        } else {
            $query = "UPDATE order_lists SET status = 0, send_date = NULL WHERE orderlist_id = '$id'";
        }

        $go_update = mysqli_query($connection, $query);

        if($go_update) {
            // Redirect back to the order details page after updating
            header("location:order_detail.php?cus_upd=$id");
        } else {
            // Handle the case where the update query fails
            echo "Error updating order status: " . mysqli_error($connection);
        }
    } else {
        // Handle the case where 'cus_upd' is not set in the URL parameters
        echo "Order ID is not specified";
    }
?>




