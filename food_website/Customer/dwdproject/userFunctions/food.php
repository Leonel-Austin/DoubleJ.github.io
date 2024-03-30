<?php 

function searchFood()
{
  global $connection;
  $data = $_POST['search'];
  $query = "SELECT * FROM food WHERE food_name LIKE '%$data%'";
  $go_query = mysqli_query($connection, $query);
  $count_result = mysqli_num_rows($go_query);
  if($count_result == 0) {
    echo '<div class="well well-lg"> Sorry, no results found! <a href="index.php">Back</a></div>';
  }
  elseif($count_result>0) {
    while($out = mysqli_fetch_array($go_query)) {
      $food_id = $out['food_id'];
      $food_name = $out['food_name'];
      $category_id = $out['category_id'];
      $price = $out['food_price'];
      $photo = $out['food_image'];
        
      $display = '<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">';
      $display .= '<div style="background-color: white-smoke; height: 280px;" class="product-item card mb-4">'; 
      $display .= '<div class="product-img card-body position-relative overflow-hidden">';     
      $display .= '<img class="img-fluid w-100" src="../../../images/' . $photo . '" alt="">';         
      $display .= '<div class="product-action">';         
      $display .= '<a class="btn btn-outline-dark btn-square" onclick="addToCart(' . $food_id . ', \'' . $food_name . '\', ' . $price . ', \'' . $photo . '\')"><i class="fa fa-shopping-cart"></i></a>';
      $display .= '<a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-heart"></i></a>';            
      $display .= '</div>';        
      $display .= '</div>';    
      $display .= '<div class="text-center pb-4 card-footer" style="height: 120px; background-color: red;">';   
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
  }
}
function pizza() {
  global $connection;
  // Query to select pizza items from the database
  $query = "SELECT * FROM food WHERE food_name LIKE '%pizza%'";
  $go_query = mysqli_query($connection, $query);
  $count_result = mysqli_num_rows($go_query);
  if($count_result == 0) {
      echo '<div class="well well-lg"> Sorry, no results found! <a href="index.php">Back</a></div>';
  } elseif($count_result > 0) {
      while($out = mysqli_fetch_array($go_query)) {
          // Display pizza items
          // Modify this part according to your HTML structure
          $food_id = $out['food_id'];
          $food_name = $out['food_name'];
          $category_id = $out['category_id'];
          $price = $out['food_price'];
          $photo = $out['food_image'];

          $display = '<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">';
      $display .= '<div style="background-color: white-smoke; height: 280px;" class="product-item card mb-4">'; 
      $display .= '<div class="product-img card-body position-relative overflow-hidden">';     
      $display .= '<img class="img-fluid w-100" src="../../../images/' . $photo . '" alt="">';         
      $display .= '<div class="product-action">';         
      $display .= '<a class="btn btn-outline-dark btn-square" href="add-to-cart.php" onclick="addToCart(' . $food_id . ', \'' . $food_name . '\', ' . $price . ', \'' . $photo . '\')"><i class="fa fa-shopping-cart"></i></a>';
      $display .= '<a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-heart"></i></a>';            
      $display .= '</div>';        
      $display .= '</div>';    
      $display .= '<div class="text-center pb-4 card-footer" style="height: 120px; background-color: red;">';   
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
  }
}
function burger() {
  global $connection;
  // Query to select pizza items from the database
  $query = "SELECT * FROM food WHERE food_name LIKE '%burger%'";
  $go_query = mysqli_query($connection, $query);
  $count_result = mysqli_num_rows($go_query);
  if($count_result == 0) {
      echo '<div class="well well-lg"> Sorry, no results found! <a href="index.php">Back</a></div>';
  } elseif($count_result > 0) {
      while($out = mysqli_fetch_array($go_query)) {
          // Display pizza items
          // Modify this part according to your HTML structure
          $food_id = $out['food_id'];
          $food_name = $out['food_name'];
          $category_id = $out['category_id'];
          $price = $out['food_price'];
          $photo = $out['food_image'];

          $display = '<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">';
      $display .= '<div style="background-color: white-smoke; height: 280px;" class="product-item card mb-4">'; 
      $display .= '<div class="product-img card-body position-relative overflow-hidden">';     
      $display .= '<img class="img-fluid w-100" src="../../../images/' . $photo . '" alt="">';         
      $display .= '<div class="product-action">';         
      $display .= '<a class="btn btn-outline-dark btn-square" href="add-to-cart.php" onclick="addToCart(' . $food_id . ', \'' . $food_name . '\', ' . $price . ', \'' . $photo . '\')"><i class="fa fa-shopping-cart"></i></a>';
      $display .= '<a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-heart"></i></a>';            
      $display .= '</div>';        
      $display .= '</div>';    
      $display .= '<div class="text-center pb-4 card-footer" style="height: 120px; background-color: red;">';   
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
  }
}
function sandwich() {
  global $connection;
  // Query to select pizza items from the database
  $query = "SELECT * FROM food WHERE food_name LIKE '%sandwich%'";
  $go_query = mysqli_query($connection, $query);
  $count_result = mysqli_num_rows($go_query);
  if($count_result == 0) {
      echo '<div class="well well-lg"> Sorry, no results found! <a href="index.php">Back</a></div>';
  } elseif($count_result > 0) {
      while($out = mysqli_fetch_array($go_query)) {
          // Display pizza items
          // Modify this part according to your HTML structure
          $food_id = $out['food_id'];
          $food_name = $out['food_name'];
          $category_id = $out['category_id'];
          $price = $out['food_price'];
          $photo = $out['food_image'];

          $display = '<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">';
      $display .= '<div style="background-color: white-smoke; height: 280px;" class="product-item card mb-4">'; 
      $display .= '<div class="product-img card-body position-relative overflow-hidden">';     
      $display .= '<img class="img-fluid w-100" src="../../../images/' . $photo . '" alt="">';         
      $display .= '<div class="product-action">';         
      $display .= '<a class="btn btn-outline-dark btn-square" href="add-to-cart.php" onclick="addToCart(' . $food_id . ', \'' . $food_name . '\', ' . $price . ', \'' . $photo . '\')"><i class="fa fa-shopping-cart"></i></a>';
      $display .= '<a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-heart"></i></a>';            
      $display .= '</div>';        
      $display .= '</div>';    
      $display .= '<div class="text-center pb-4 card-footer" style="height: 120px; background-color: red;">';   
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
  }
}
function fries() {
  global $connection;
  // Query to select pizza items from the database
  $query = "SELECT * FROM food WHERE food_name LIKE '%fries%'";
  $go_query = mysqli_query($connection, $query);
  $count_result = mysqli_num_rows($go_query);
  if($count_result == 0) {
      echo '<div class="well well-lg"> Sorry, no results found! <a href="index.php">Back</a></div>';
  } elseif($count_result > 0) {
      while($out = mysqli_fetch_array($go_query)) {
          // Display pizza items
          // Modify this part according to your HTML structure
          $food_id = $out['food_id'];
          $food_name = $out['food_name'];
          $category_id = $out['category_id'];
          $price = $out['food_price'];
          $photo = $out['food_image'];

          $display = '<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">';
      $display .= '<div style="background-color: white-smoke; height: 280px;" class="product-item card mb-4">'; 
      $display .= '<div class="product-img card-body position-relative overflow-hidden">';     
      $display .= '<img class="img-fluid w-100" src="../../../images/' . $photo . '" alt="">';         
      $display .= '<div class="product-action">';         
      $display .= '<a class="btn btn-outline-dark btn-square" href="add-to-cart.php" onclick="addToCart(' . $food_id . ', \'' . $food_name . '\', ' . $price . ', \'' . $photo . '\')"><i class="fa fa-shopping-cart"></i></a>';
      $display .= '<a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-heart"></i></a>';            
      $display .= '</div>';        
      $display .= '</div>';    
      $display .= '<div class="text-center pb-4 card-footer" style="height: 120px; background-color: red;">';   
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
  }
}
function create_accu() {
  global $connection;
  global $user_name;
  global $password;
  global $email;
  global $phone;
  global $address;
  $hpass = md5($password);
  $query = "SELECT * FROM user WHERE user_name ='$user_name' AND password='$hpass'";
  $user_query = mysqli_query($connection,$query);
  $count=mysqli_num_rows($user_query);
  if($count>0){
    echo "<script>window.alert('already exists')</script>";
    } else{
    $query="insert into user (user_name,password,email,phone,address,role)";
    $query.="values ('$user_name','$hpass','$email','$phone','$address','Customer')";
    $go_query=mysqli_query($connection,$query);
    
      
    if(!$go_query){
        die("QUERY FAILED".mysqli_error($connection));
    } else {
      echo "<script>window.alert('you successfully created an account')</script>";
    }
  }
}



?>

<script>
  // Function to add an item to the cart and store in local storage
  function addToCart(food_id, food_name, price, photo) {
        console.log(photo);
        // Retrieve existing cart items from local storage or initialize an empty array
        var cartItems = JSON.parse(localStorage.getItem('cart')) || [];

        // Check if the item already exists in the cart
        var existingItemIndex = cartItems.findIndex(item => item.food_id === food_id);

        if (existingItemIndex !== -1) {
            // If the item already exists, update its quantity and price
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

        // Store updated cart items back to local storage
        localStorage.setItem('cart', JSON.stringify(cartItems));

        localStorage.setItem('cart_count', localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')).length : 0)

        location.reload();
    }
</script>