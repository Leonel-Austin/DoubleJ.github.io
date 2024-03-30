<?php
    session_start();
    include 'connect.php';
    include 'function.php';

    if(isset($_POST['login'])) {
        admin_login();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../CSS/adm_login.css">
</head>
<body>
    <div class="container pb-5">
        <div class= "typewriter">
            <p>Hello! Welcome Admin, Nice to Meet You!</p>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-lg-3 text-center pt-4">
                        <img src="../images/DoubleJ_logo.png" alt="" width="150px" height="150px">
                        <h1 class="mt-2"><b>Double J</b></h1>
                    </div>
                    <div class="col-12 col-lg-6">
                        <form method="POST" class="bg-secondary-subtle px-4 pb-4 border border-dark border-1 rounded shadow-lg p-3">
                            <h2 class="text-center"><i class="fa-solid fa-user-lock"></i>  Admin Login</h2>
                            <div class="form-floating mb-3 border border-secondary rounded">
                                <input type="text" class="form-control" id="adminname" name="adminname" placeholder="Enter Admin Name" required>
                                <label for="adminname">Enter Admin Name</label>
                            </div>
                            <div class="form-floating mb-3 border border-secondary rounded">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Admin Name" required>
                                <label for="password">Enter Password</label>
                            </div>
                            <button type="submit" name="login" class="loginbtn btn form-control rounded-pill">Login <i class="fa-solid fa-circle-right"></i></button>
                        </form> 
                    </div>
                    <div class="col-12 col-lg-3"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            var wait = document.getElementById('adminname');
            wait.focus();
        }
    </script>
</body>
</html>