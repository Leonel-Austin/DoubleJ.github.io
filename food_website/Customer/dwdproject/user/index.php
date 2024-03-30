

<?php 
session_start();
include "../database/connect.php";
include "../userFunctions/category.php";
include "../userFunctions/food.php";
include "header.php";
$getquery = "SELECT * FROM food";
$perpage = 8;
$go_query = mysqli_query($connection, $getquery);
$num = mysqli_num_rows($go_query);
$num = ceil($num/$perpage);
$page = '';


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
        <div class="mt-2 p-3">
            <h3 class="text-success text-center me-4">
                <?php 
                    if(isset($_SESSION['Customer'])) {
                        echo "Welcome Customer, " .$_SESSION['Customer'];
                    }
                ?>
            </h3>
            
        </div>
        <div class="row content">
            <div class="col-lg-12 d-flex justify-content-start">
                <div class="row my-1"> 
                    <form action="search.php" method="POST" class="d-xl-none d-lg-none d-flex mb-4">
                        <input class="form-control bg-white border border-1 border-dark me-2" name="search" type="search" placeholder="Search">
                        <button type="submit" class="btn btn-sm btn-light">Search</button>
                    </form>
                    
                    <?php 
                        $show_product = 0;
                        
                        if(isset($_GET['page'])) {
                            $page = $_GET['page'];
                            // Assuming $perpage is defined somewhere in your code
                            $show_product = ($page * $perpage) - $perpage;
                        }
                        
                        $query = "SELECT * FROM food LIMIT $show_product, $perpage";
                        $go_query = mysqli_query($connection, $query);
                        while($out = mysqli_fetch_array($go_query)) {
                            $food_id = $out['food_id'];
                            $food_name = $out['food_name'];
                            $category_id = $out['category_id'];
                            $price = $out['food_price'];
                            $photo = $out['food_image'];
                            
                            $display = '<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 menu-card">';
                            $display .= '<div style="background-color: white-smoke; height: 280px;" class="product-item card mb-4">'; 
                            $display .= '<div class="product-img card-body position-relative overflow-hidden">';     
                            $display .= '<img class="img-fluid w-100" src="../../../images/' . $photo . '" alt="">';         
                            $display .= '<div class="product-action">';         
                            $display .= '<a class="btn btn-outline-dark btn-square" href="add-to-cart.php" onclick="addToCart(' . $food_id . ', \'' . $food_name . '\', ' . $price . ', \'' . $photo . '\')"><i class="fa fa-shopping-cart"></i></a>';
                            $display .= '<a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-heart"></i></a>';            
                            $display .= '</div>';        
                            $display .= '</div>';    
                            $display .= '<div class="text-center text-wrap pb-4 card-footer" style="height: 120px; background-color: #c40000;">';   
                            $display .= '<a class="h6 text-decoration-none text-white" href="">' . $food_name . '</a>';       
                            $display .= '<div class="d-flex align-items-center justify-content-center mt-2 text-dark">';        
                            $display .= '<h5 class="text-white">'.'MMK ' . $price . '</h5>';
                            $display .= '</div>';      
                            $display .= '<div class="d-flex align-items-center justify-content-center mb-1">';       
                            $display .=  '<small class="fa fa-star text-warning mr-1"></small>';
                            $display .=  '<small class="fa fa-star text-warning mr-1"></small>';        
                            $display .=  '<small class="fa fa-star text-warning mr-1"></small>';
                            $display .=  '<small class="fa fa-star text-warning mr-1"></small>';
                            $display .=  '<small class="fa fa-star text-warning mr-1"></small>';
                            $display .=  '</div></div></div></div>';
                            echo $display;                
                        }
                    ?>

                </div>
                
            </div>
            <nav aria-label="Page navigation example">
                        <ul class="pagination" style=" justify-content: center; align-item: center;">
                            <?php if ($page > 1) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="index.php?page=<?php echo ($page - 1); ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $num; $i++) : ?>
                                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                    <a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if (is_numeric($page) && $page < $num) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="index.php?page=<?php echo ($page + 1); ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
            <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
        </div>
        <?php 

        require("./footer.php");

        ?>
    </div>
</div>
<!-- products end -->
<script>
    function addToCart(food_id, food_name, price, photo) {
        <?php if (isset($_SESSION['customer_id'])) : ?>
        var cartItems = JSON.parse(localStorage.getItem('cart')) || [];

        var existingItemIndex = cartItems.findIndex(item => item.food_id === food_id);

        if (existingItemIndex !== -1) {
            cartItems[existingItemIndex].quantity++;
            cartItems[existingItemIndex].totalPrice = cartItems[existingItemIndex].quantity * price;
        } else {
            // If the item doesn't exist, add it to the cart
            var newItem = {
                photo: photo,
                food_id: food_id,
                food_name: food_name,
                price: price,
                quantity: 1,
                totalPrice: price
            };
            cartItems.push(newItem);
        }

        localStorage.setItem('cart', JSON.stringify(cartItems));

        var cartCount = cartItems.reduce((total, item) => total + item.quantity, 0);
        localStorage.setItem('cart_count', cartCount);

        updateCartCount();

        <?php else : ?>
            // If user is not logged in, redirect to login page
            window.location.href = 'login.php';
        <?php endif; ?>
        event.preventDefault();
    }

    function updateCartCount() {
        var cartItems = JSON.parse(localStorage.getItem('cart')) || [];

        var cartCount = cartItems.reduce(function(total, item) {
            return total + item.quantity;
        }, 0);

        document.getElementById('cart-count').innerText = cartCount;
    }
</script>
</body>


