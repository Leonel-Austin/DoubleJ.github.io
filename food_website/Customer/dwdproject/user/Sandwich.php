

<?php 
session_start();
include "../database/connect.php";
include "../userFunctions/category.php";
include "../userFunctions/food.php";
require("./header.php");

global $connection;
$categories = getCategories();


?>
<head>
    <style>
        .main-content {
            background-color: whitesmoke;
        }
        .side-bar {
            position: fixed;
            background-color: #1b212e;
            height: 100vh;
        }
        .side-bar .navbar .navbar-nav .nav-item .nav-link {
            color: #ffff00;
        }
        .side-bar .navbar .navbar-nav .nav-item .dropdown-item {
            color: white;
            background-color: #1b212e;
        }
        .side-bar .navbar .navbar-nav .nav-item .dropdown-item:hover {
            color: red;
        }
        .side-bar .navbar .navbar-nav .nav-item .dropdown-item.active {
            color: red;
        }
        /* Media query for tablets and smaller screens */
        @media (max-width: 992px) {
            
            .product-img {
                height: 220px !important;
                width: 220px !important;
                margin:0 auto !important;
            }
            .card-footer {
                height: 120px !important;
                background: #c40000 !important;
            }
        }

        /* Media query for smartphones and smaller screens */
        @media (max-width: 768px) {

            .product-img {
                height: 250px !important;
                width: 250px !important;
                margin:0 auto !important;
            }
            .card-footer {
                height: 100px !important;
                background: #c40000 !important;
            }
        }
        /* Media query for extra small devices */
        @media (max-width: 576px) {

            .product-img {
                height: 250px !important;
                width: 250px !important;
                margin:0 auto !important;
            }
            .card-footer {
                height: 100px !important;
                background: #c40000 !important;
            }
        }
    </style>
</head>
<body>
<body>
    <!-- products start -->
<div class="main-content mt-5 pt-3 row" >
<div class="side-bar col-xl-2 col-lg-2 pb-3 d-xl-block d-lg-block d-none">
    <nav class="navbar bg-transparent">
        <div class="navbar-nav w-100">
            <div class="nav-item active">
                <a href="#" class="nav-link ms-lg-1 fw-bold" data-bs-toggle="dropdown">
                    <i class="fa fa-list ms-lg-1 me-lg-2 ms-2 me-2 bg-white text-dark p-2 border rounded-circle"></i>
                    Categories
                </a>
                <div class="bg-transparent border-0">
                    <a href="Pizza.php?pizza=1" class="btn btn-lg btn-primary form-control dropdown-item">Pizza</a>
                    <a href="Hamburger.php?burger=1" class="btn btn-lg btn-primary form-control dropdown-item">Hamburger</a>
                    <a href="Sandwich.php?sandwich=1" class="btn btn-lg btn-primary form-control dropdown-item">Sandwich</a>
                    <a href="Fries.php?fries=1" class="btn btn-lg btn-primary form-control dropdown-item">Fries</a>
                </div>
            </div>
        </div>
    </nav>
</div>

      <div class="col-xl-2 col-lg-2"></div>  <!-- Please Don't Delete This Line. -->
        <div class="col-xl-10 col-lg-10">
            <div class="row content">
                <div class="col-lg-12 d-flex justify-content-start ">
                    <div class="row my-4"> 
                    <h2 class="text-dark">Sandwich Menu</h2>
                        <?php
                            
                            if(isset($_GET['sandwich'])) {
                                sandwich();
                            }
                        ?> 
                    </div>
                </div>
            
                <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
            </div>
        <?php 

        require("./footer.php");

        ?>
    </div>
</div>
<!-- products end -->

</body>
</body>
    
