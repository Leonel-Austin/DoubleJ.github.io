<?php
    session_start();
    include 'connect.php';
    include 'function.php';
    $orders = mysqli_query($connection, "SELECT * FROM order_lists ORDER BY orderlist_id")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/doublej.css">
    <style>
        .odl {
            color: #ffff00;
            background-color: #3f3f3f;
        }
        .b-vod {
            color: #ffffff;
            background-color: #2b2b2b;
        }
        .b-vod:hover {
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
                    
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="odl p-2">Order Lists</h2>
                            </div>
                            <div class="panel-body">
                            <table class="table table-striped text-center table-bordered">
                                <tr>
                                    <th class="text-white" style="background-image: linear-gradient(180deg, #df1e1e, #8d0000);" width="5%">No</th>
                                    <th class="text-white" style="background-image: linear-gradient(180deg, #df1e1e, #8d0000);" width="15%">Customer Name</th>
                                    <th class="text-white" style="background-image: linear-gradient(180deg, #df1e1e, #8d0000);" width="40%">Food Item(s)</th>
                                    <th class="text-white" style="background-image: linear-gradient(180deg, #df1e1e, #8d0000);" width="20%">Ordered_Date</th>
                                    <th class="text-white" style="background-image: linear-gradient(180deg, #df1e1e, #8d0000);" width="20%">Action</th>
                                </tr>
                                <?php
                                    while($out=mysqli_fetch_array($orders)) {
                                        $check = $out['status'];
                                        if($check>0) {
                                            $show='<tr class="mark">';
                                        } else { 
                                            $show='<tr>';
                                        }
                                        $show.='<td>'.$out['orderlist_id'].'</td>';
                                        $show.='<td>'.$out['customer_name'].'</td>';
                                        $show.='<td>';
                                        $orderid=$out['orderlist_id'];
                                        $order=mysqli_query($connection, "SELECT order_detail.*, food.* FROM
                                            order_detail LEFT JOIN food ON
                                            order_detail.food_id = food.food_id WHERE
                                            order_detail.orderlist_id = '$orderid'
                                        ");
                                        while($row = mysqli_fetch_assoc($order)) {
                                            $show.='<ul><li>'.$row['food_name'].' <span class="badge text-bg-danger">'.$row['food_qty'].'</span></li></ul>';
                                        }
                                        $show.='</td>'; 
                                        $show.='<td>'.$out['order_date'].'</td>';
                                        $show.='<td><a href="order_detail.php?cus_upd='.$out['orderlist_id'].'" class="btn b-vod"> View Order Details </a></td>';
                                        $show.='</tr>';
                                        echo $show;
                                
                                    }
                                ?>
                        </table>
                            </div>
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