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
        .add-btn {
            background-color: #198754;
        }
        .add-btn:hover {
            background-color: #444444;
        }
        .trash {
            color: #ff3c3c;
        }
        .trash:hover {
            color: #444444;
        }
        .pagination {
            justify-content: center;
            margin-top: 10px;
        }
        .pagination li a {
            color: #ffffff;
            background-color:  #198754;
        }
        .pagination li a:hover {
            color: #ffffff;
            background-color: #444444;
        }
        .pagination .page-item.active .page-link {
            background-color: #444444;
            border-color: #444444;
            color: #ffffff;
        }

    </style>
</head>
<?php 
    $getquery="SELECT * FROM user";
    $perpage=10;
    $go_query=mysqli_query($connection,$getquery);
    $num=mysqli_num_rows($go_query);
    $num=ceil($num/$perpage);
    $page='';
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
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="users.php"><span><i class="fa-solid fa-list"></i></span> User List</a></li>
                            <li class="nav-item"><a class="nav-link" aria-current="page" href="./add-user.php"><span><i class="fa-solid fa-user-plus"></i></span> Add User</a></li>
                        </ul>
                    </div>
                    <div class="card m-3">
                        <div class="card-body" style="background-image: linear-gradient(315deg, #198754, #005232);">
                            <span class=" text-light">
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
					<div class="row g-0">
						<div class="col-1"></div>
						<div class="col-10">
			                <table class="table table-striped table-bordered">
				                <tr  class="text-center">
                                <th class="text-light bg-success">User ID</th>
                                <th class="text-light bg-success">User Name</th>
                                <th class="text-light bg-success">User Role</th>
                                <th class="text-light bg-success">Action</th>
                                </tr>
				                <?php
                                    if(isset($_GET['action'])&& $_GET['action']=='delete'){
                                    del_user();
                                    }	
                                    $user_list = 0; // Initialize $user_list
                                    // Calculate the starting position based on the page number
                                    if(isset($_GET['page']) && $_GET['page'] > 1) {
                                        $page = $_GET['page'];
                                        $start_user_id = ($page - 1) * $perpage + 1; // Calculate the starting user ID for the page
                                        $query = "SELECT * FROM user WHERE user_id >= $start_user_id LIMIT $perpage";
                                    } else {
                                        // For page 1, fetch the first 20 users
                                        $query = "SELECT * FROM user LIMIT $perpage";
                                    }
                                    $go_query=mysqli_query($connection,$query);
                                    // Check for errors in query execution
                                    if(!$go_query) {
                                        die("Error: " . mysqli_error($connection));
                                    }
                                    while($row=mysqli_fetch_array($go_query)){
                                    $user_id=$row['user_id'];
                                    $user_name=$row['user_name'];
                                    $user_role=$row['role'];
                                    echo "<tr>";
                                    echo "<td  class='text-center'>$user_id</td>";
                                    echo "<td  class='text-center'>$user_name</td>";
                                    echo "<td class='text-center'>$user_role</td>";
                                    echo "<td class='text-center'><a href='users.php?action=delete&id={$user_id}'
                                    class='fa-solid fa-trash trash' onclick=\"return confirm('Are you sure to delete this account?')\"></a></td>";
                                    echo "</tr>";
                                    }
				                ?>
                                <tr>
                                    <td colspan="4" align="right">
                                    <a href="add-user.php" class="btn add-btn text-light">
                                    <span class="fa-solid fa-plus text-light"></span> Add User</a></td>
                               </tr>
                            </table>
						</div>
						<div class="col-1"></div>
				    </div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php if ($page > 1) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="users.php?page=<?php echo ($page - 1); ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $num; $i++) : ?>
                                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                    <a class="page-link" href="users.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if (is_numeric($page) && $page < $num) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="users.php?page=<?php echo ($page + 1); ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>

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