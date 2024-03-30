<?php
session_start();
include "check_login.php";
// Assuming database connection is established in this file
include "../database/connect.php";
include "header.php";

// Check if the 'customer_id' session variable is set
if (!isset($_SESSION['customer_id'])) {
    // Redirect the user to the login page or handle the situation as per your application's logic
    // For example:
    header("Location:cart.php");
    exit(); // Stop further execution
}

// Retrieve orders for a specific customer_id
$customer_id = $_SESSION['customer_id']; // Assuming customer_id is stored in session

// Fetch orders from order_lists table
$order_query = "SELECT * FROM order_lists WHERE customer_id='$customer_id'";
$order_result = mysqli_query($connection, $order_query);

// Fetch order details from order_details table
$order_details = array();
while ($order = mysqli_fetch_assoc($order_result)) {
    $order_id = $order['orderlist_id'];
    $order_detail_query = "SELECT od.*, f.food_image FROM order_detail od
                            JOIN food f ON od.food_id = f.food_id
                            WHERE od.orderlist_id='$order_id'";
    $order_detail_result = mysqli_query($connection, $order_detail_query);
    $details = array();
    while ($detail = mysqli_fetch_assoc($order_detail_result)) {
        $details[] = $detail;
    }
    $order['details'] = $details;
    $order_details[] = $order;
    $status = $order['status'] == 1 ? 'bg-success' : 'bg-warning';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            cursor: pointer;
            position: relative;
        }
        .status {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
        }
        .status.completed {
            color: #28a745;
        }
        .status.pending {
            color: #ffc107;
        }
        .order-details {
            padding: 0;
        }
        .order-details .list-group-item {
            border: none;
            background-color: transparent;
        }
        .order-details .list-group-item:last-child {
            border-bottom: none;
        }

        .active-style.active {
            color: white !important; /* Text color for active tab */
        }
        .active-style:not(.active) {
            color: black !important; /* Text color for inactive tab */
        }
    </style>
</head>
<body class="bg-white">
    <div class="container" style="margin-top: 100px;">
        <h2 class="text-center text-dark mb-5">Order History</h2>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active-style active" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active-style" id="completed-tab" data-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">Completed</a>
        </li>
        </ul>
        <div class="tab-content mt-5" id="myTabContent">
            <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                <?php if (empty($order_details) || !any_successful_orders($order_details, 0)): ?>
                    <div class="text-center mb-5 text-dark">No pending order history to show. <br> Please order some food and come back here.</div>
                    <?php else: ?>
                    <?php foreach ($order_details as $order): ?>
                        <?php if ($order['status'] == 0): ?>
                            <div class="card mb-3">
                                <div class="card-header" data-toggle="collapse" data-target="#order_<?php echo $order['orderlist_id']; ?>">
                                    <button class="btn btn-link text-dark" type="button">
                                        Order No: <?php echo $order['order_no']; ?>
                                    </button>
                                    <span class="status <?php echo $order['status'] == 1 ? 'completed' : 'pending' ?>">
                                        <?php echo $order['status'] == 1 ? 'Completed' : 'Pending' ?>
                                    </span>
                                </div>
                                <div id="order_<?php echo $order['orderlist_id']; ?>" class="collapse">
                                    <h5 class="card-title text-dark text-center mt-5">Order Details</h5>
                                    <div class="card-body order-details d-flex justify-content-between">
                                        <div class="" style="width: 500px;">
                                            <p class="mb-0 my-4 ml-2"><strong>Customer Name:</strong> <?php echo $order['customer_name']; ?></p>
                                            <p class="mb-0 my-4 ml-2"><strong>Customer Phone:</strong> <?php echo $order['customer_phone']; ?></p>
                                            <p class="mb-0 my-4 ml-2"><strong>Payment Type:</strong> <?php echo $order['payment_type']; ?></p>
                                            <p class="mb-0 my-4 ml-2"><strong>Card No:</strong> <?php echo $order['card_no']; ?></p>
                                            <p class="mb-0 my-4 ml-2"><strong>Order Date:</strong> <?php echo $order['order_date']; ?></p>
                                            <p class="mb-0 my-4 ml-2"><strong>Send Date:</strong> <?php echo $order['send_date']; ?></p>
                                        </div>
                                        <div style="width:100%">
                                            <?php foreach ($order['details'] as $detail): ?>
                                                <div class="d-flex justify-content-around align-items-center" style="border: 1px solid #000; border-radius: 10px; margin: 10px 0;">
                                                    <div style="width: 20%;">
                                                        <img src="../../../images/<?php echo $detail['food_image'] ?>" class="my-2" width="100" height="70" alt="<?php echo $detail['food_image'] ?>">
                                                        <p><?php echo $detail['food_name'] ?></p>
                                                    </div>
                                                    <div><span><?php echo $detail['food_qty'] ?></span></div>
                                                    <div><span>MMK <?php echo $detail['total_amount'] ?></span></div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>


                
            </div>
            <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                <?php if (empty($order_details) || !any_successful_orders($order_details, 1)): ?>
                    <div class="text-center mb-5 text-dark"> Completed orders will be shown here.</div>
                    <?php else: ?>
                    <?php foreach ($order_details as $order): ?>
                        <?php if ($order['status'] == 1): ?>
                            <div class="card mb-3">
                                <div class="card-header" data-toggle="collapse" data-target="#order_<?php echo $order['orderlist_id']; ?>">
                                    <button class="btn btn-link text-dark" type="button">
                                        Order No: <?php echo $order['order_no']; ?>
                                    </button>
                                    <span class="status <?php echo $order['status'] == 1 ? 'completed' : 'pending' ?>">
                                        <?php echo $order['status'] == 1 ? 'Completed' : 'Pending' ?>
                                    </span>
                                </div>
                                <div id="order_<?php echo $order['orderlist_id']; ?>" class="collapse">
                                    <h5 class="card-title text-dark text-center mt-5">Order Details</h5>
                                    <div class="card-body order-details d-flex justify-content-between">
                                        <div class="" style="width: 500px;">
                                            <p class="mb-0 my-4 ml-2"><strong>Customer Name:</strong> <?php echo $order['customer_name']; ?></p>
                                            <p class="mb-0 my-4 ml-2"><strong>Customer Phone:</strong> <?php echo $order['customer_phone']; ?></p>
                                            <p class="mb-0 my-4 ml-2"><strong>Payment Type:</strong> <?php echo $order['payment_type']; ?></p>
                                            <p class="mb-0 my-4 ml-2"><strong>Card No:</strong> <?php echo $order['card_no']; ?></p>
                                            <p class="mb-0 my-4 ml-2"><strong>Order Date:</strong> <?php echo $order['order_date']; ?></p>
                                            <p class="mb-0 my-4 ml-2"><strong>Send Date:</strong> <?php echo $order['send_date']; ?></p>
                                        </div>
                                        <div style="width:100%">
                                            <?php foreach ($order['details'] as $detail): ?>
                                                <div class="d-flex justify-content-around align-items-center" style="border: 1px solid #000; border-radius: 10px; margin: 10px 0;">
                                                    <div style="width: 20%;">
                                                        <img src="../../../images/<?php echo $detail['food_image'] ?>" width="100" height="100" alt="<?php echo $detail['food_image'] ?>">
                                                        <p><?php echo $detail['food_name'] ?></p>
                                                    </div>
                                                    <div><span><?php echo $detail['food_qty'] ?></span></div>
                                                    <div><span>$ <?php echo $detail['total_amount'] ?></span></div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php require('footer.php'); ?>
</body>
</html>
<?php
function any_successful_orders($orders, $status) {
    foreach ($orders as $order) {
        if ($order['status'] == $status) {
            return true;
        }
    }
    return false;
}
?>

