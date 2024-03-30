<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/doublej.css">
    <style>
        label {
            font-weight: bold;
        }
        .submit-btn {
            color: #ffffff;
            font-weight: bold;
            background-image: linear-gradient(#444444, #050505, #444444) ;
            border: 2px solid #3b3b3b;
        }
        .submit-btn:hover {
            color: #050505;
            font-weight: bold;
            background-image: linear-gradient(#afafaf, #ffffff, #afafaf) ;
            border: 2px solid #3b3b3b;
        }
    </style>
</head>
<?php
    session_start(); 
    include 'connect.php';
    include 'function.php';

    if(isset($_POST['add_product'])) {
        add_product();
    }
 ?>
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
                    <a href="./food-menu.php" class="list-group-item active"><i class="fa-solid fa-burger"></i> <span class="d-none d-lg-inline"> Food Menu</span></a>
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
                    
                    <div class="tab-content mb-2">
                        <ul class="nav nav-tabs nav-justified border-dark">
                            <li class="nav-item"><a class="nav-link" aria-current="page" href="./food-menu.php"><span><i class="fa-solid fa-list"></i></span> Menu List</a></li>
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="add-menu.php"><span><i class="fa-solid fa-plus"></i></span> Add Menu</a></li>
                        </ul>
                    </div>
                    
                    <div class="card m-3">
                        <div class="card-body" style="background-image: linear-gradient(315deg, #ff9100, #ff3300);">
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

                    <div class="row mt-4">
                        <div class="col-lg-3 col-sm-2"></div>
                        <div class="col-lg-6 col-sm-8 bg-secondary-subtle p-4 border border-dark border-1 rounded">
                            <form class="p-2"  method="post" enctype="multipart/form-data">
                                <h3 class="text-center fw-bold">Add Menu Form</h3>
                                <div class="form-group my-3">
                                    <label for="">Food Name</label>
                                    <input type="text" name="food_name" class="form-control" required>
                                </div>
                                <div class="form-group my-3">
                                    <label for="">Category Name</label>
                                    <select name="category_id" class="form-control">
                                        <?php 
                                            $query = "select * from categories";
                                            $go_query = mysqli_query($connection,$query);
                                            while($row = mysqli_fetch_array($go_query)) {
                                                $cat_id = $row['category_id'];
                                                $cat_name = $row['category_name'];
                                                if($product_cat_id == $cat_id){
                                                    echo "<option value = {$cat_id} selected> {$cat_name}</option>";
                                                } else {
                                                    echo "<option value = {$cat_id}> {$cat_name} </option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group my-3">
                                    <label for="">Price</label>
                                    <input type="text" name="price" class="form-control" required>
                                </div>
                                <div class="form-group my-3">
                                    <label for="">Choose Image</label><br>
                                    <input type="file" name="photo" required>
                                    
                                </div>
                                <button type="submit" name="add_product" class="btn btn-dark submit-btn mt-3 form-control rounded-pill">Add Menu</button>
                            </form>
                        </div>  
                        <div class="col-lg-3 col-sm-2"></div>
                    </div>
                                
                </div>
                <br><br><hr> <!-- Please don't delete this line! -->
                <footer id="footer">
                    &copy;2024Copyright:DoubleJ.com
                </footer>
            </main>
        </div> 
    </section>

</body>
</html>