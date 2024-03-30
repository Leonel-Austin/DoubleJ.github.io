<?php
    session_start();
    include 'connect.php';
    include 'function.php';
    
    if(isset($_GET['cus_upd'])) {
        $cus_upd = $_GET['cus_upd']; 
        $orders = mysqli_query($connection, "SELECT * FROM order_lists WHERE orderlist_id = '$cus_upd' ORDER BY orderlist_id");
        if(mysqli_num_rows($orders) > 0) {
            // Rows found, continue with displaying order details
            // ...
        } else {
            // No rows found for the provided 'cus_upd', handle it accordingly
            echo "No data found";
        }
    } else {
        // 'cus_upd' is not set in the URL parameters, handle it accordingly
        echo "Order ID is not specified";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/doublej.css">
    <style>
        .ods {
            color: #ffff00;
            background-color: #3f3f3f;
        }
        .fo-table th {
            background-image: linear-gradient(180deg, #df1e1e, #8d0000);
        }
        .b-deli {
            color: #ffffff;
            background-color: #2b2b2b;
        }
        .b-deli:hover {
            color: #ffffff;
            background-color: #444444; 
        }
        .b-undo {
            color: #ffffff;
            background-color: #c70000;
        }
        .b-undo:hover {
            color: #ffffff;
            background-color: #444444;
        }
        .b-back {
            color: #ffffff;
            background-color: #008080;
        }
        .b-back:hover {
            color: #ffffff;
            background-color: #444444;
        }
    </style>
</head>
<body>
    <section class="container-fluid g-0">
        <div class="row g-0">
            <nav class="col-2 border-end border-2 side-nav">
                <h3 class="h4 py-3">
                    <img src="../images/DoubleJ_logo.png" alt="Double J Logo" width="80px" height="80px" style="border-radius: 50%;" class="me-2">
                    <span><a class="navbar-brand d-none d-lg-inline text-light fw-bold">Double J</a></span>
                </h3>       
                
                <div class="list-group d-block text-center text-lg-start">
                    <a href="dashboard.php" class="list-group-item"><i class="fa-solid fa-chart-bar"></i> <span class="d-none d-lg-inline"> Dashboard</span></a>
                    <a href="./categories.php" class="list-group-item"><i class="fa-solid fa-list"></i> <span class="d-none d-lg-inline"> Categories</span></a>
                    <a href="./food-menu.php" class="list-group-item"><i class="fa-solid fa-burger"></i> <span class="d-none d-lg-inline"> Food Menu</span></a>
                    <a href="./users.php" class="list-group-item"><i class="fa-solid fa-user"></i> <span class="d-none d-lg-inline"> Users</span></a>
                    <a href="./orders.php" class="list-group-item active"><i class="fa-solid fa-cart-shopping"></i> <span class="d-none d-lg-inline"> Orders</span></a>
                </div> 
            </nav>
            <div class="col-2"></div>
            <main class="col-10 main-content">
                <div class="sticky-top border-bottom border-secondary border-2">
                    <nav class="Topnav navbar navbar-expand-lg navbar-dark navbar-fixed-top bg-dark">
                        <h5 class="text-warning ms-5" >[Administration Panel]</h5>             
                        <div class="flex-fill"></div>
                        <div class="Topnav-icon">           
                            <ul class="nav nav-ul">
                                <li class="nav-item"><a href="dashboard.php" class="nav-link"><i class="fa-solid fa-house"></i></a></li>
                                <li class="nav-item"><a href="logout.php" class="nav-link"><i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="p-3 page-content">
                    <div class="card m-3">
                        <div class="card-body" style="background-image: linear-gradient(315deg, #df1e1e, #8d0000);">
                            <span style="color: white">
                                    <h2 class="card-title">Welcome Admin,
                                <?php
                                if(isset($_SESSION['Admin'])){
                                     echo $_SESSION['Admin'];
                                } else {
                                $_SESSION['Admin'] = '';
                                }
                                ?>
                                </h2>
                            </span>
                        </div>
                    </div><hr>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="p-2 ods">Order Details</h2>
                        </div>
                        <div class="panel-body p-3 bg-white">
                            <?php
                                 // Fetch the order details
                                $order = mysqli_query($connection, " SELECT order_detail.*, food.*, order_lists.*
                                FROM order_detail 
                                INNER JOIN food ON order_detail.food_id = food.food_id 
                                INNER JOIN order_lists ON order_detail.orderlist_id = order_lists.orderlist_id 
                                WHERE order_detail.orderlist_id = '".$_GET['cus_upd']."'
                                    ");   
                                
                                // Initialize total amount variable
                                $totalAmount = 0;
                                // Check if the query was successful and if there are any rows returned
                                if($order && mysqli_num_rows($order) > 0) {
                                    // Fetch the row
                                    $row = mysqli_fetch_assoc($order);
                                    // Add the first row's amount to the total amount
                                    $totalAmount += $row['total_amount'];
                            ?>
                                <div>
                                    <b><span><i class="fa-solid fa-hashtag"></i></span> Order ID: </b> <?php echo $row['orderlist_id'] ?> <br>
                                    <b><span><i class="fa-solid fa-id-card"></i></span> Customer Name: </b> <?php echo $row['customer_name'] ?> <br>
                                    <b><span><i class="fa-solid fa-phone"></i></span> Phone Number: </b> <?php echo $row['customer_phone'] ?> <br>
                                    <b><span><i class="fa-solid fa-city"></i></span> Delivery Address: </b> <?php echo $row['customer_address'] ?> <br>
                                </div>
                                
    
                                <table class="table table-striped table-bordered border-1 border-secondary text-center mt-3 mb-4">
                                    <tr class="fo-table">
                                        <th class=" text-white">Food Title</th>
                                        <th class=" text-white">Quantity</th>
                                        <th class=" text-white">Total Price</th>
                                    </tr>
                                    <?php 
                                        // Display the first row
                                            echo '<tr>';
                                            echo '<td>' . $row['food_name'] . '</td>';
                                            echo '<td>' . $row['food_qty'] . '</td>';
                                            echo '<td>'.'MMK ' . $row['total_amount'] . '</td>';
                                            echo '</tr>';
                                        // Loop through each row of the result set
                                        while($row = mysqli_fetch_assoc($order)) {
                                            echo '<tr>';
                                            echo '<td>' . $row['food_name'] . '</td>';
                                            echo '<td>' . $row['food_qty'] . '</td>';
                                            echo '<td>'. 'MMK ' . $row['total_amount'] . '</td>';
                                            echo '</tr>';
                                            // Accumulate the unit prices to calculate the total amount
                                            if(mysqli_num_rows($order) > 1) {
                                                $totalAmount += $row['total_amount'];
                                            }
                                        }
                                        // Display the total amount row after the loop
                                        echo '<tr>';
                                        echo '<td colspan="2" class="text-end">Total Amount:</td>';
                                        echo '<td>'.'MMK ' . $totalAmount . '</td>';
                                        echo '</tr>';
                                    ?>
                                </table>

                                <?php 
                                    // Fetch the order details related to 'cus_upd'
                                    $orders = mysqli_query($connection, "SELECT * FROM order_lists WHERE orderlist_id = '$cus_upd' ORDER BY orderlist_id");

                                    // Check if there are rows returned by the query
                                    if(mysqli_num_rows($orders) > 0) {
                                        while($row = mysqli_fetch_assoc($orders)) {
                                            echo '<h3 style="text-decoration: underline; font-weight: bold;" class="mb-3"> Order Date Details and Status </h3>';
                                            echo '<table class="table table-striped table-bordered border-1 border-secondary">';
                                            echo '<tr><td><strong>Ordered Date:</strong></td><td>' . $row['order_date'] . '</td></tr>';
                                            $chesec = $row['status'];
                                            if($chesec > 0) {
                                                echo '<tr><td><strong>Sened Date:</strong></td><td>' . $row['send_date'] . '</td></tr>';
                                            } else {
                                                echo '<tr><td><strong>Sended Date:</strong></td><td>----/--/--</td></tr>';
                                            }
                                            
                                            echo '<tr><td><strong>Status:</strong></td><td>';
                                            if ($row['status']) {
                                                echo '<sm style="color: green;">Delivered</sm>';
                                            } else {
                                                echo '<sm style="color: red;">Not Delivered</sm>';
                                            }
                                            echo '</td></tr>';

                                            echo '</table>';

                                            // Button section
                                            echo '<div class="d-flex justify-content-end">';
                                            echo '<a href="orders.php" class="btn b-back me-2">Back</a>';
                                            if ($row['status']) {
                                                echo '<a href="status.php?cus_upd=' . $row['orderlist_id'] . '&status=0" class="btn b-undo">Undo</a>';
                                            } else {
                                                echo '<a href="status.php?cus_upd=' . $row['orderlist_id'] . '&status=1" class="btn b-deli">Mark as Delivered</a>';
                                            }
                                            echo '</div>';
                                        }
                                    }
                                ?>


                                <?php
                                    } else {
                                        // Handle case where no data is found
                                        echo "<tr><td colspan='2'>No data found</td></tr>";
                                    }
                                ?>

                        </div>
                    </div>

                </div>
                <br><br><hr> <!-- Please don't delete this line! -->
                <div id="footer">
                    &copy;2024Copyright:DoubleJ.com
                </div>
            </main>
        </div> 
    </section>
    
</body>
</html>