<?php
// === Admin Login === // 
function admin_login() {
    global $connection;
    $name = $_POST['adminname'];
    $password = $_POST['password'];
    $hpass = md5($password);

    // Construct query to fetch user with given admin name and role 'Admin'
    $query = "SELECT * FROM user WHERE user_name='$name' AND role='Admin' LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        // Admin user found, fetch user data
        $user = mysqli_fetch_assoc($result);
        $db_password = $user['password'];

        // Compare hashed passwords
        if ($db_password == $hpass) {
            // Password is correct, set session and redirect to dashboard
            $_SESSION['Admin'] = $name;
            header('location:dashboard.php');
            exit;
        } else {
            // Password is incorrect
            echo "<script>window.alert('Invalid Password')</script>";
            echo "<script>window.location.href='index.php'</script>";
        }
    } else {
        // Admin user not found or role is not 'Admin'
        echo "<script>window.alert('Invalid Admin Name')</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
}



// === Category === //
 function insert_category()
	 {	  global $connection;
	 $cat_name=$_POST['category_name'];
	 if($cat_name==""){
			 echo"<script>window.alert('enter name')</script>";
		 }
	 elseif($cat_name!="")
	 	{
			$query="select * from categories where category_name='$cat_name'";
		 $ch_query=mysqli_query($connection,
								$query);
			$count=mysqli_num_rows($ch_query);
				if($count>0)
				{
					echo"<script>window.alert('already exists')</script>";
				}
				else
				{
					$query="insert into categories(category_name)values('$cat_name')";
					$go_query=mysqli_query($connection,$query);
					if(!$go_query)
					{
						die("QUERY FAILED".mysqli_error($connection));}
						else{
							echo"<script>window.alert('successfully inserted')</script>";
							}
				}
	 }
	 }
	function update_category(){
		global $connection;
		$cat_name=$_POST['category_name'];
		$cat_id=$_GET['c_id'];
		$query="update categories set category_name='$cat_name' where category_id='$cat_id'";
		$go_query=mysqli_query($connection,$query);
		if(!$go_query)
		{
			die("QUERY FAILED".mysqli_error($connection));
		}
			header("location:categories.php");
	}
	function del_category(){
		global $connection;
		$c_id=$_GET['c_id'];
		$query="delete from categories where category_id='$c_id'";
		$go_query=mysqli_query($connection,$query);
		header("location:categories.php");        
	}

	// === User === //
	function add_user() {
		global $connection;
		$user_name = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$cpass = $_POST['confirmpassword'];
		if($password!=$cpass) {
			echo "<script>window.alert('Password and Confirm Password must be same.')</script>";
		} else if($password!="" && $user_name!=""){
			$query = "SELECT * FROM user WHERE user_name='$user_name' AND password = '$password'";
			$ch_query = mysqli_query($connection, $query);
			$count = mysqli_num_rows($ch_query);
			if($count>0) {
				echo "<script>window.alert('This Product is already exists')</script>";
			} else {
				$hashvalue = md5($password);
				$user_role = $_POST['usertype'];
				$query = "INSERT INTO user(user_name,email,password,role)";
				$query.="values('$user_name','$email','$hashvalue','$user_role')";
				$go_query = mysqli_query($connection, $query);
				if(!$go_query) {
					die("QUERY FAILED".mysqli_error($connection));
				}
				
				// Redirect to the correct page after adding the user
				header("Location: users.php?page=''");
				exit;

			}
		}
	}
	function del_user()	{
		global $connection;
	   $u_id=$_GET['id'];
	   $query="DELETE FROM user WHERE user_id='$u_id'";
	   $go_query=mysqli_query($connection,$query);
   }

   /* Product Functions */
   // Add Product
   function add_product(){
	global $connection;
	$food_name=$_POST['food_name'];
	$cat_id=$_POST['category_id'];
	$price=$_POST['price'];
	$photo=$_FILES['photo']['name'];
	if(is_numeric($price)==false)
	{
	echo "<script>window.alert('enter product Price is numeric value')</script>";
	}
	elseif($photo==""){
	echo "<script>window.alert('Choose product Images')</script>";
	}

	elseif($food_name!=""&&$photo!=""){
		$query="SELECT * FROM food WHERE food_name='$food_name'";
		$ch_query=mysqli_query($connection,$query);
		$count=mysqli_num_rows($ch_query);
		if($count>0){
			echo "<script>window.alert('This Product is already exists')</script>"; 
		} else{ $query="INSERT INTO food(food_name,category_id,food_price,food_image)";
			$query.="values('$food_name','$cat_id','$price','$photo')";
			$go_query=mysqli_query($connection,$query);
			if(!$go_query){
				die("QUERY FAILED".mysqli_error($connection));   
			} else {
				echo "<script language=\"javascript\">window.alert('successfully inserted')</script>";
				move_uploaded_file($_FILES['photo']['tmp_name'],'../images/'.$photo);
				header("location:food-menu.php");   
			}
		}
	}
}

// Delete Product
function del_product(){
	global $connection;
	$p_id=$_GET['p_id'];
	$query="DELETE FROM food WHERE food_id='$p_id'";
	$go_query=mysqli_query($connection,$query);    
}

// Update Product
function update_product(){
	global $connection;
	$product_id=$_GET['p_id'];
	$product_name=$_POST['product_name'];
	$cat_id=$_POST['category_id'];
	$price=$_POST['price'];
	$photo=$_FILES['photo']['name'];
	if(!$photo) {
		$query="UPDATE food SET food_name='$product_name',category_id='$cat_id',";
		$query.="food_price='$price' where food_id='$product_id'";
	} else {
		$query="UPDATE food SET food_name='$product_name',category_id='$cat_id',price='$price',photo='$photo' where food_id='$product_id'";
	}
	
	$go_query=mysqli_query($connection,$query);
	if(!$go_query) {
		die("QUERY FAILED".mysqli_error($connection));
	} else {
		move_uploaded_file($_FILES['photo']['tmp_name'],'../images/'.$photo);
	}
	header("location:food-menu.php");
}
?>