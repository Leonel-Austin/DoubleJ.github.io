<?php
    session_start();
    include "../database/connect.php";
    include "../userFunctions/food.php"; 

    if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
		print_r($email);
        // Validate email and password fields
        $errors = array(
            'email' => '',
            'password' => ''
        );

        if (empty($email)) {
            $errors['email'] = 'Email cannot be empty';
        }

        if (empty($password)) {
            $errors['password'] = 'Password cannot be empty';
        }

        // Proceed if no validation errors
        if (empty($errors['email']) && empty($errors['password'])) {
            $hpass = md5($password);

			$query = "SELECT * FROM user WHERE email='$email' LIMIT 1"; // Change the query to select user based on email
			$go_query=mysqli_query($connection,$query);
			$num_rows = mysqli_num_rows($go_query); // Count rows returned by the query

			if ($num_rows > 0) {
				$out=mysqli_fetch_array($go_query);
				$db_user_id=$out['user_id'];
				$db_email=$out['email'];
				$db_user_name=$out['user_name'];
				$db_password=$out['password'];
				$db_user_role=$out['role'];
				if($db_email==$email && $db_password==$hpass && $db_user_role=='Admin'){
					$_SESSION['Admin']=$db_user_name;
					$_SESSION['customer_id']=$db_user_id;
					header('location:Admin/food-menu.php');
				}
				elseif($db_email==$email || $db_password==$hpass){
					$_SESSION['Customer']=$db_user_name;
					$_SESSION['customer_id']=$db_user_id;
					header('location:index.php');
				}
				else {
					header('location:login.php');
				}
			}
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login your account</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<style>
		body {
			background-color: white;
		}
	</style>
</head>
<body>
<div class="limiter">
		<div class="container-login100" >
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class=" " method="POST" role="form">
					<span class="login100-form-title p-b-49">
						Login
					</span>

					<div class="wrap-input100 m-b-23" data-validate="Email is required">
						<span class="label-input100">Email</span>
						<input class="input100" type="email" value="<?php if(isset($email)) {echo $email;} ?>" name="email" placeholder="Type your email">
						<?php if(isset($errors['email']) && !empty($errors['email'])): ?>
							<label class="text-danger"><?php echo $errors['email']; ?></label>
						<?php endif; ?>
						<span class="focus-input100" data-symbol="&#xf15a;"></span>
					</div>

					<div class="wrap-input100" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" value="<?php echo isset($password) ? $password : ''; ?>" name="password" placeholder="Type your password">
						<?php if(isset($errors['password']) && !empty($errors['password'])): ?>
							<label class="text-danger"><?php echo $errors['password']; ?></label>
						<?php endif; ?>
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					
					
					<div class="container-login100-form-btn mt-4">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="login">
								Login
							</button>
						</div>
                        <span style="font-weight: 600;text-align:center;margin-top:20px" >Not have an account yet ?<br> <a href="register.php" style="font-weight: 600;" >Create your new account now !</a></span>
					</div>

					

					
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
</body>
</html>