<?php 
    session_start();
    include "../database/connect.php";
	include "../userFunctions/food.php";
	include "header.php"; 
    if(isset($_POST['register'])){
        $user_name=$_POST['username'];
        $password=$_POST['password'];
        $confirm_password=$_POST['cpassword'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $address=$_POST['address'];
            $errors=array(
            'username'=>'',
            'password'=>'',
            'confirm_password'=>'',
            'match_password'=>'',
            'email'=>'',
            'phone'=>'',
            'address'=>'',
            );

			
			

        if ($user_name==''){
            $errors['username']='User Name must be enter';
        }else {
            if(strlen($user_name)<3){
                $errors['username']='User Name need to be longer';
            }
        }
        
        if($confirm_password==''){
            $errors['confirm_password']='This Field could not be empty';
        }else {
            if($password!=$confirm_password){
                $errors['match_password']='Password Do not match';
            }
        }

        if($password==''){
            $errors['password']='This field could not be empty';
        }else {
            if(strlen($password)<3){
                $errors['password']='Password need to be longer';
            }
        }
                
        if($email==''){
            $errors['email']='This field could not be empty';
        }
                
        if($phone==''){
            $errors['phone']='This field could not be empty';
        }
                
        if($address==''){
            $errors['address']='This field could not be empty';
        }

                
        foreach($errors as $key=>$value){
            if(empty($value)){
                unset($errors[$key]);
            }
        }

		

        if(empty($errors)){
            echo"<h3>Registration Success</h3>";
            create_accu();
            $user_name = $password = $confirm_password = $email = $phone = $address = $photo ='';

        }

		
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login your account</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,html{
            background: gray;
        }
    </style>
</head>
<body>
<div style="box-shadow: 1px 1px 2px 3px;" class="limiter ">
		<div class="container-login100" >
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" method="POST" action="register.php">
					<span style="font-size: 30px;" class="login100-form-title p-b-49">
						Register your account
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Username is required">
                    <i class="fa-solid fa-user me-2"></i><span class="form-label ">Username</span>
						<input class="input100" type="text" value="<?php if(isset($user_name)) {echo $user_name;} ?>" name="username" placeholder="Type your username">
						<label class="text-danger"><?php echo isset($errors['username'])?$errors['username']:'' ?></label>
					</div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate = "Email is required">
                    <i class="fa-solid fa-envelope me-2"></i><span class="label-input100">Email</span>
						<input class="input100" type="email" value="<?php echo isset($email) ? $email : ''; ?>" name="email" placeholder="Type your Email">
						<label class="text-danger"><?php echo isset($errors['email'])?$errors['email']:'' ?></label>
						
					</div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate = "Phone number is required">
                    <i class="fa-solid fa-phone me-2"></i><span class="label-input100">Phone Number</span>
						<input class="input100" type="text" value="<?php echo isset($phone) ? $phone : ''; ?>" name="phone" placeholder="Type your phone number">
						<label class="text-danger"><?php echo isset($errors['phone'])?$errors['phone']:'' ?></label>
					</div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <i class="fa-solid fa-key me-2"></i><span class="label-input100">Password</span>
						<input class="input100" type="password" value="<?php echo isset($password) ? $password : ''; ?>" name="password" placeholder="Type your password">
						<label class="text-danger"><?php echo isset($errors['password'])?$errors['password']:'' ?></label>
					</div>

                    <div class="wrap-input100 validate-input" data-validate="Confirm Password is required">
                    <i class="fa-solid fa-key me-2"></i><span class="label-input100">Confirm Password</span>
						<input class="input100" type="password" value="<?php echo isset($confirmpassword) ?$confirmpassword:'' ?>" name="cpassword" placeholder="Retype your confirm password">
						<label class="text-danger"><?php echo isset($errors['confirm_password'])?$errors['confirm_password']:'' ?></label>
                                    <label class="text-danger"><?php echo isset($errors['match_password'])?$errors['match_password']:'' ?></label>
					</div>
					
					

                    <div class="wrap-input100 validate-input m-b-23" data-validate = "Address is required">
                    <i class="fa-solid fa-map me-2"></i><span class="label-input100">Address</span>
						<input class="input100" type="text" <?php echo isset($address) ? $address : ''; ?> name="address" placeholder="Type your address">
						<label class="text-danger"><?php echo isset($errors['address']) ? $errors['address'] : ''; ?></label>
					</div>

			
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="register">
								Register
							</button>
						</div>
                        <span style="font-weight: 600;text-align:center;margin-top:20px" >Already have an account ?<br> <a href="login.php" style="font-weight: 600;color:black" >Login your account now!</a></span>
					</div>

					

					
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
</body>
</html>