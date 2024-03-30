<?php
    session_start();
    include 'connect.php';
    include 'function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/doublej.css">
    <style>
        .bt-vds {
            color: #ffffff;
            font-weight: bold;
            background-image: linear-gradient(#444444, #050505, #444444) ;
            border: 2px solid #3b3b3b;
        }
        .bt-vds:hover {
            color: #050505;
            font-weight: bold;
            background-image: linear-gradient(#afafaf, #ffffff, #afafaf) ;
            border: 2px solid #3b3b3b;
        }
        @media only screen and (max-width: 768px) {
            .count {
                font-size: 40px; 
            }
        }

        @media only screen and (max-width: 480px) {
            .count {
                font-size: 30px; 
            }
        }
    </style>
</head>
<body style="background-image: linear-gradient(90deg, #ffe259, #ffa751);">
    <section class="container-fluid g-0">
        <div class="row g-0">
            <nav class="col-2 border-end border-2 side-nav">
                <h3 class="h4 py-3">
                    <img src="../images/DoubleJ_logo.png" alt="Double J Logo" width="80px" height="80px" style="border-radius: 50%;" class="me-2">
                    <span><a class="navbar-brand d-none d-lg-inline text-light fw-bold">Double J</a></span>
                </h3>       
                
                <div class="list-group d-block text-center text-lg-start">
                    <a href="dashboard.php" class="list-group-item active"><i class="fa-solid fa-chart-bar"></i> <span class="d-none d-lg-inline"> Dashboard</span></a>
                    <a href="./categories.php" class="list-group-item"><i class="fa-solid fa-list"></i> <span class="d-none d-lg-inline"> Categories</span></a>
                    <a href="./food-menu.php" class="list-group-item"><i class="fa-solid fa-burger"></i> <span class="d-none d-lg-inline"> Food Menu</span></a>
                    <a href="./users.php" class="list-group-item"><i class="fa-solid fa-user"></i> <span class="d-none d-lg-inline"> Users</span></a>
                    <a href="./orders.php" class="list-group-item"><i class="fa-solid fa-cart-shopping"></i> <span class="d-none d-lg-inline"> Orders</span></a>
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
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mt-1">
                                    <div class="card-body" style="background-color:#2b2b2b;">
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
                                </div>
                            </div>
                        </div><hr/>
                        <div class="row">
                            <div class="col-md-4 offset-md-2">
                                <div class="card text-white" style="background-image: linear-gradient(315deg, #1bcfb4, #006b62); margin-bottom:30px;">
                                    <div class="card-body">
                                        <h3 class="card-title"><span><i class="fa-solid fa-list"></i></span> Categories</h3>
                                        <div class="d-flex justify-content-center">
                                            <h2 class="card-text">
                                                <span class="count" style="color: #ffffff; font-size: 50px;">
                                                    <?php
                                                    $total_categories = "SELECT category_id FROM categories";
                                                    $get_total_categories = mysqli_query($connection, $total_categories);
                                                    $num_categories = mysqli_num_rows($get_total_categories);
                                                    echo $num_categories;
                                                    ?>
                                                </span>
                                            </h2>
                                        </div>
                                        <a href="categories.php" class="btn bt-vds border-secondary rounded-pill d-block mx-auto" style="margin-top: 5px;">
                                            View Details
                                            <i class="fas fa-angle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card" style="background-image: linear-gradient(315deg, #198754, #005232); margin-bottom:30px;">
                                    <div class="card-body">
                                        <h3 class="card-title" style="color:white;"><span><i class="fa-solid fa-user"></i></span> Users</h3>
                                        <div class="d-flex justify-content-center">
                                            <h2 class="card-text">
                                                <span class="count" style="color: #ffffff; font-size: 50px;">
                                                    <?php
                                                    $total_users = "SELECT user_id FROM user";
                                                    $get_total_users = mysqli_query($connection, $total_users);
                                                    $num_users = mysqli_num_rows($get_total_users);
                                                    echo $num_users;
                                                    ?>
                                                </span>
                                            </h2>
                                        </div>
                                        <a href="users.php" class="btn bt-vds border-secondary rounded-pill d-block mx-auto" style=" margin-top: 5px;">
                                            View Details
                                            <i class="fas fa-angle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 offset-md-2">
                                <div class="card text-white" style="background-image: linear-gradient(315deg, #ff9100, #ff3300); margin-bottom:30px;">
                                    <div class="card-body">
                                        <h3 class="card-title"><span><i class="fa-solid fa-burger"></i></span> Food Menu</h3>
                                        <div class="d-flex justify-content-center">
                                            <h2 class="card-text">
                                                <span class="count" style="color: #ffffff; font-size: 50px;">
                                                    <?php
                                                    $total_food = "SELECT food_id FROM food";
                                                    $get_total_food = mysqli_query($connection, $total_food);
                                                    $num_food = mysqli_num_rows($get_total_food);
                                                    echo $num_food;
                                                    ?>
                                                </span>
                                            </h2>
                                        </div>
                                        <a href="food-menu.php" class="btn bt-vds border-secondary rounded-pill d-block mx-auto" style="margin-top: 5px;">
                                            View Details
                                            <i class="fas fa-angle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card" style="background-image: linear-gradient(315deg, #df1e1e, #8d0000);">
                                    <div class="card-body">
                                        <h3 class="card-title" style="color:white;"><span><i class="fa-solid fa-cart-shopping"></i></span> Orders</h3>
                                        <div class="d-flex justify-content-center">
                                            <h2 class="card-text">
                                                <span class="count" style="color: #ffffff; font-size: 50px;">
                                                    <?php
                                                    $total_orders = "SELECT orderlist_id FROM order_lists";
                                                    $get_total_orders = mysqli_query($connection, $total_orders);
                                                    $num_orders = mysqli_num_rows($get_total_orders);
                                                    echo $num_orders;
                                                    ?>
                                                </span>
                                            </h2>
                                        </div>
                                        <a href="orders.php" class="btn bt-vds border-secondary rounded-pill d-block mx-auto" style="margin-top: 5px;">
                                            View Details
                                            <i class="fas fa-angle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br><hr/> <!-- Please don't delete this line! -->
                    <div id="footer">
                        &copy;2024Copyright:DoubleJ.com
                    </div>
            </main>
        </div>
    </section>

</body>
</html>