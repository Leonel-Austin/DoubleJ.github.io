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
    <title>Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/doublej.css">
    <style>
        .btn-gradient{
            background-image: linear-gradient(315deg, #1bcfb4, #006b62); 
            color: white;
            margin-top: 18px;
        }
        .btn-gradient:hover{
            background-image: linear-gradient(315deg, #006b62, #1bcfb4 );
            color: white;
        }
    </style>
</head>
<body style="background-image: linear-gradient(90deg, #ffe259, #ffa751);">
    <section class="container-fluid g-0">
        <div class="row g-0" style="width:100%;">
            <nav class="col-2 border-end border-2 side-nav">
                <h3 class="h4 py-3">
                    <img src="../images/DoubleJ_logo.png" alt="Double J Logo" width="80px" height="80px" style="border-radius: 50%;" class="me-2">
                    <span><a class="navbar-brand d-none d-lg-inline text-light fw-bold">Double J</a></span>
                </h3>       
                
                <div class="list-group d-block text-center text-lg-start">
                    <a href="dashboard.php" class="list-group-item"><i class="fa-solid fa-chart-bar"></i> <span class="d-none d-lg-inline"> Dashboard</span></a>
                    <a href="./categories.php" class="list-group-item active"><i class="fa-solid fa-list"></i> <span class="d-none d-lg-inline"> Categories</span></a>
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
                
                <?php
	            if(isset($_POST['add_category'])){
		            insert_category();}
                if(isset($_POST['update_category'])){
                    update_category();}
                if(isset($_GET['action'])&&$_GET['action']=='delete')
                {
                    del_category();
                }
                ?>

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mt-1">
                                    <div class="card-body" style="background-image: linear-gradient(315deg, #1bcfb4, #006b62);">
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
                            <div class="col-md-8" style="padding-top:50px;">
                                <table class="table table-bordered">
                                <tr class="text-center">
					                <th style="color:white; background-image: linear-gradient(180deg, #1bcfb4, #006b62);">ID</th>
					                <th style="color:white; background-image: linear-gradient(180deg, #1bcfb4, #006b62);">Name</th>
					                <th style="color:white; background-image: linear-gradient(180deg, #1bcfb4, #006b62);">Action</th>
				                </tr>
                                <?php
                                $query = "select * from categories";
                                $go_query = mysqli_query($connection,$query);
                                $counter = 0;
                                while($row=mysqli_fetch_array($go_query))
                                {
                                $class = ($counter % 2 == 0) ? '' : 'table-success';
                                echo "<tr class='$class text-center'>";
                                echo "<td style='color:#DC582A;'>" . $row['category_id'] . "</td>";
                                echo "<td style='color:#DC582A;'>" . $row['category_name'] . "</td>";
                                echo "<td style='color:#DC582A;'>
                                        <a href='categories.php?action=edit&c_id=" . $row['category_id'] . "'><i class='fas fa-pen' style='color:#DC582A'></i></a> | 
                                        <a href='categories.php?action=delete&c_id=" . $row['category_id'] . "'><i class='fas fa-trash' style='color:#DC582A'></i></a>
                                    </td>";
                                echo "</tr>"; 
                                $counter++;
                                }
                                ?>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <div class="btn-group" style="padding-top: 60px; padding-bottom: 14px;">
                                    <form method="post">
                                        <div class="form-group">
                                            <label style="color: #000080; padding-bottom: 12px;">Add Category</label>
                                            <div class="input-group">
                                                <span class="input-group-text" style="background-color: #444444; color: white; border-color: #444444;"><i class="fas fa-plus"></i></span>
                                                <input class="form-control" type="text" name="category_name"/>
                                            </div>
                                        </div>
                                        <button type="submit" name="add_category" class="btn btn-gradient btn-fw">
                                            Add Category
                                        </button>
                                    </form>
                                </div>
                                <div class="btn-group">
                                    <?php
                                    if(isset($_GET['action']) && $_GET['action'] == 'edit') {
                                        $cat_id = $_GET['c_id'];
                                        $query = "SELECT * FROM categories WHERE category_id='$cat_id'";
                                        $go_query = mysqli_query($connection, $query);
                                        while($out = mysqli_fetch_array($go_query)) {
                                        $cat_name = $out['category_name'];
                                    ?>
                                    <form method="post">
                                        <input type="hidden" name="category_id" value="<?php echo $cat_id; ?>">
                                        <div class="form-group">
                                            <label style="color: #000080; padding-bottom: 14px;">Update Category</label>
                                            <div class="input-group">
                                                <span class="input-group-text" style="background-color: #444444; color: white; border-color: #444444"><i class="fas fa-pen" style="width: 14px;"></i></span>
                                                <input type="text" name="category_name" class="form-control" value="<?php echo $cat_name ?>">
                                            </div>
                                        </div>
                                        <button type="submit" name="update_category" class="btn btn-gradient btn-fw">
                                            Update Category
                                        </button>
                                    </form>
                                        <?php
                                            }
                                        }
                                        ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br><hr/>
                    <div id="footer">
                        &copy;2024 Copyright: DoubleJ.com
                    </div>
            </main>
        </div> 
    </section>

</body>
</html>
