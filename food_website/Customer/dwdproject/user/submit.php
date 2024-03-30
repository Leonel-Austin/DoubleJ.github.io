<?php
session_start();
include "../database/connect.php"; // Assuming this file contains database connection code
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $customer_id = $_POST['user_id'];
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $customer_address = $_POST['customer_address'];
    $payment_type = $_POST['payment_type'];
    $card_no = $_POST['card_no'];
    $order_date = date('Y-m-d');
    $status = 0;
    $order_no = date('ymdhis');

    // Assuming you have stored food details in localStorage
    // Retrieve food details from localStorage
    $food_details = json_decode($_POST['food_details'], true);

    // Insert into order_lists table
    $insert_order_query = "INSERT INTO order_lists (customer_id, order_no, customer_name, customer_address, customer_phone, payment_type, card_no, order_date, send_date, status) VALUES ('$customer_id', '$order_no', '$customer_name', '$customer_address', '$phone_number', '$payment_type', '$card_no', '$order_date', '$order_date', '$status')";
    $order_list = mysqli_query($connection, $insert_order_query);

    if($order_list)
    {
        // Retrieve the order ID of the inserted order
        $order_id = mysqli_insert_id($connection);

        // Insert into order_details table for each food item
        foreach ($food_details as $food) {
            $food_id = $food['food_id'];
            $food_name = $food['food_name'];
            $quantity = $food['quantity'];
            $total_amount = $food['totalPrice'];

            // Insert into order_details table
            $insert_order_detail_query = "INSERT INTO order_detail (orderlist_id, food_id, food_name, food_qty, total_amount) VALUES ('$order_id', '$food_id', '$food_name', '$quantity', '$total_amount')";
            $order_detail_result = mysqli_query($connection, $insert_order_detail_query);
            if(!$order_detail_result)
            {
                header("Location: submit_order.php?error=1");
                exit();
            }
        }

        // Redirect to order_success.php
        header("Location: order_success.php");
        exit();
    }else{
        header("Location: submit_order.php?error=1");
        exit();
    }
} else {
    // If the form is not submitted, redirect to the form page
    header("Location: submit_order.php");
    exit();
}
?>
