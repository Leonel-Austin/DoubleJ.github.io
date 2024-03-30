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
    <title>Users</title>
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
<body>
    <?php
        if(isset($_POST['add_user'])) {
            add_user();
        }
    ?>
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
                    <a href="./users.php" class="list-group-item active"><i class="fa-solid fa-user"></i> <span class="d-none d-lg-inline"> Users</span></a>
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
                    <div class="tab-content">
                        <ul class="nav nav-tabs nav-justified border-dark">
                            <li class="nav-item"><a class="nav-link" aria-current="page" href="./users.php"><span><i class="fa-solid fa-list"></i></span> User List</a></li>
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="add-user.php"><span><i class="fa-solid fa-user-plus"></i></span> Add User</a></li>
                        </ul>
                    </div>
                    <div class="card m-3">
                        <div class="card-body" style="background-image: linear-gradient(315deg, #198754, #005232);">
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
                    <form action="" method="POST" class="row">

                        <div class="col-lg-3 col-sm-2"></div>
                        <div class="col-lg-6 col-sm-8 bg-secondary-subtle p-4 border border-dark border-1 rounded">
                            <h3 class="text-center fw-bold">Add User Form</h3>
                            <div class="form-group">
                                <label for="username">User Name:</label>
                                <input type="text" name="username" id="username" class="form-control border-1 border-secondary" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="form-control border-1 border-secondary" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control border-1 border-secondary" required>
                            </div>
                            <div class="form-group">
                                <label for="confirmpassword">Confirm Password:</label>
                                <input type="password" name="confirmpassword" id="confirmpassword" class="form-control border-1 border-secondary" required>
                            </div>
                            <div class="form-group">
                                <label for="usertype">User Type:</label>
                                <select name="usertype" id="usertype" class="form-control border-1 border-secondary">
                                    <option value="Admin">--- Admin ---</option>
                                    <option value="Customer">--- Customer ---</option>
                                </select>
                            </div>
                            <button type="submit" name="add_user" class="btn btn-dark submit-btn mt-3 form-control rounded-pill">Submit</button>
                        </div>
                        <div class="col-lg-3 col-sm-2"></div>
                    </form>
                </div>
                <br><br><hr> <!-- Please don't delete this line! -->
                <footer id="footer">
                    &copy;2024Copyright:DoubleJ.com
                </footer>
            </main>
        </div> 
    </section>
    <script>
        window.onload = function() {
            var wait = document.getElementById('username');
            wait.focus();
        }
    </script>
</body>
</html>