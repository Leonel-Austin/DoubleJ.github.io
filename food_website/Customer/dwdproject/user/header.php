<?php
    // Check if user is logged in
    $logged_in = isset($_SESSION['Customer']) || isset($_SESSION['Admin']);
     // Check if $out contains 'food_id' key and is not null
     $food_id = isset($out['food_id']) ? $out['food_id'] : null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Double J </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">


    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">


    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            overflow-x: hidden;
        }
        .dj-logo {
            border-radius: 50%;
        }
        .nav-item .nav-link {
            color: #ffff00;
        }
        .nav-item .dropdown-item {
            color: white;
            background-color: #1b212e !important;
        }
        .nav-item .dropdown-item:hover {
            color: red;
        }
        .nav-item .dropdown-item.active {
            color: red;
        }
        .nav-link span:hover {
            color: #ffff00;
        }

        .rounded-span {
            display: inline-block;
            width: 19px; /* Adjust width as needed */
            height: 19px; /* Adjust height as needed */
            border-radius: 50%; /* To make it round */
            background-color: red;
            color: white;
            text-align: center;
            line-height: 19px; /* Vertically center text */
        }
        
    </style>
</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-dark  p-0 py-1 ms-auto fixed-top" style="background-color: #111924;">
        <div class="container-fluid">
            
            <a href="index.php" class="navbar-brand ">
                <img src="../images/DoubleJ_logo.png" style="width: 50px; height: 50px;object-fit:cover" class="me-3 dj-logo" alt="logo">
                Double J
            </a>

            <form action="search.php" method="POST" class="d-none d-md-flex">
                <input class="form-control bg-white border-0 me-2" name="search" type="search" placeholder="Search">
                <button type="submit" class="btn btn-sm btn-light">Search</button>
            </form>

            <div class="navbar">
                <div class="nav-item">
                    <a href="index.php" class="nav-link " style="color:white" >
                        <i class="fa-solid fa-home"></i>
                        <span class="d-none d-lg-inline-flex">Home</span>
                    </a>
                </div>

                <div class="nav-item">                    
                    <a href="cart.php" class="nav-link" style="color:white">
                    <i class="fa-solid fa-cart-shopping"></i> <span class="rounded-span cart-count-badge" id="cart-count"></span>
                        <span class="d-none d-lg-inline-flex">Cart</span>
                    </a>                   
                </div>
                <div class="nav-item">                    
                    <a href="order_history.php" class="nav-link" style="color:white">
                    <i class="fa-solid fa-clock"></i>
                        <span class="d-none d-lg-inline-flex">Order History</span>
                    </a>                   
                </div>



                <!-- Show or hide register and login links based on login status -->
                <?php if(!$logged_in): ?>
                    <div class="nav-item d-none d-xl-flex d-lg-flex ">
                        <a href="register.php" class="nav-link" style="color:white">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            <span class="d-none d-lg-inline-flex">Register</span>
                        </a>
                    </div>

                    <div class="nav-item d-none d-xl-flex d-lg-flex">
                        <a href="login.php" class="nav-link" style="color:white">
                            <i class="fa-solid fa-key"></i>
                            <span class="d-none d-lg-inline-flex">Login</span>
                        </a>
                    </div>
                <?php else: ?>
                    <!-- Show logout link if user is logged in -->
                    <div class="nav-item d-none d-xl-flex d-lg-flex">
                        <a href="logout.php" class="nav-link" style="color:white">
                            <i class="fa-solid fa-power-off"></i>
                            <span class="d-none d-lg-inline-flex">Logout</span>
                        </a>
                    </div>
                <?php endif; ?>

                <button class="navbar-toggler d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                    <span  class="navbar-toggler-icon"></span>
                </button>
            </div>

            

            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel" style="background-color: #111924;">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Double J</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="offcanvas-body">
                    
                    <form action="search.php" method="POST" class="d-flex">
                        <input class="form-control bg-white border-0" name="search" type="search" placeholder="Search">
                        <button type="submit" class="btn btn-sm btn-light">Search</button>
                    </form>

                    <div class="nav-item">
                        <a href="#" class="nav-link ms-md-1 ms-sm-1 mt-2 fw-bold" data-bs-toggle="dropdown">
                            <i class="fa fa-list ms-md-1 ms-md-1 me-md-2 ms-2 me-2 bg-white text-dark p-2 border rounded-circle"></i>
                            Categories
                        </a>
                        <div class="bg-transparent border-0 ms-3 mt-2">
                            <a href="Pizza.php?pizza=1" class="btn btn-lg btn-primary form-control dropdown-item">Pizza</a>
                            <a href="Hamburger.php?burger=1" class="btn btn-lg btn-primary form-control dropdown-item">Hamburger</a>
                            <a href="Sandwich.php?sandwich=1" class="btn btn-lg btn-primary form-control dropdown-item">Sandwich</a>
                            <a href="Fries.php?fries=1" class="btn btn-lg btn-primary form-control dropdown-item">Fries</a>
                        </div>
                    </div>
                    <?php if(!$logged_in): ?>
                        <div class="nav-item d-flex my-3">
                            <a href="register.php" class="nav-link" style="color:white" >
                            <i class="fa-solid fa-right-to-bracket"></i>
                                <span class="d-inline-flex">Register</span>
                            </a>
                        </div>

                        <div class="nav-item d-flex my-3">
                            <a href="register.php" class="nav-link " style="color:white" >
                            <i class="fa-solid fa-key"></i>
                                <span class="d-inline-flex">Login</span>
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="nav-item d-flex my-3">
                            <a href="logout.php" class="nav-link " style="color:white" >
                            <i class="fa-solid fa-power-off"></i>
                                <span class="d-inline-flex">Logout</span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->
<script>
    let cartID = document.getElementById('cart-count');
    cartID.innerHTML = localStorage.getItem('cart_count') ? localStorage.getItem('cart_count') : 0;
</script>
</body>
</html>

            


     
       