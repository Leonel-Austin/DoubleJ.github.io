<?php
session_start();
include "../database/connect.php";
include "header.php";
if(!empty($_SESSION['Customer'])) {
    $user_name=$_SESSION['Customer'];
    $query="SELECT * FROM user WHERE user_name='$user_name'";
    $go_query=mysqli_query($connection,$query);
    while($out=mysqli_fetch_array($go_query)) {
        $user_name=$out['user_name'];
        $user_id=$out['user_id'];
        $phone=$out['phone'];
        $email=$out['email'];
        $address=$out['address'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
        }
        .order {
            background: -webkit-linear-gradient(227deg, #a5a2a2, #000000);
            width: 600px;
            height: 100%;
            margin-top: 100px;
            margin-buttom: 80px;
            padding: 25px;
            border: 1px solid black;
            border-radius: 20px;
        }
        label {
            color: #ffff8f;
            font-weight: bold;
        }
        input {
            background-color: white;
            color: black;
        }
        .form-group {
            margin-bottom: 5px;
        }
        .loginbtn {
            color: #ffffff;
            font-weight: bold;
            background-image: linear-gradient(#444444, #050505, #444444) ;
            border: 2px solid #5f5f5f;
        }
        .loginbtn:hover {
            color: #050505;
            font-weight: bold;
            background-image: linear-gradient(#afafaf, #ffffff, #afafaf) ;
            border: 2px solid #5f5f5f;
        }
        #footer {
            height: 50px;
            color: #ffffff;
            background-color: #2b2b2b;
            padding: 10px;
            text-align: center;
            position: relative;
            margin-bottom: 0;
            clear: left;
        }
    </style>
</head>
<body>
<?php
// Check if there's an error message in the URL
if (isset($_GET['error']) && $_GET['error'] == 1) {
    echo '<p style="color: red;">There was an error submitting the form. Please try again.</p>';
}
?>
    <div class="container-fluid row">
        <div class="col-3"></div>
        <div class="order col-6 ms-3">
            <form action="submit.php"  method="post" onsubmit="handleFormSubmission()">
                <h2 class="text-center">Order Submit Form</h2>
                <input type="hidden" id="food_details" name="food_details">
                <input type="hidden" name="user_id" value="<?php if(isset($user_id)){echo $user_id;}?>">
                <div class="form-group">
                    <label for="customer_name">Name:</label><br>
                    <input class="form-control bg-white text-dark" value="<?php if(isset($user_name)){echo $user_name;}?>" type="text" id="customer_name" name="customer_name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label><br>
                    <input class="form-control bg-white text-dark" value="<?php if(isset($email)){echo $email;}?>" type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="phone_number">Phone Number:</label><br>
                    <input class="form-control bg-white text-dark" value="<?php if(isset($phone)){echo $phone;}?>" type="tel" id="phone_number" name="phone_number" required>
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <input name="customer_address" value="<?php if(isset($address)){echo $address;}?>" type="address" class="form-control bg-white text-dark" >
                </div>

                <div class="form-group">
                    <label for="payment_type">Payment Type:</label>
                    <select class="form-control bg-white text-dark" id="payment_type" name="payment_type">
                        <option value="Credit Card">Credit Card</option>
                        <option value="Cash on Delievery">cash on delivery</option>
                        <!-- Add other payment types as needed -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="card_no">Card Number:</label>
                    <input class="form-control bg-white text-dark" type="text" id="card_no" name="card_no" required><br>
                </div>
                <div class="form-group">
                    <input type="hidden" value="<?php echo $user_id ?>" name="user_id" />
                    <input class="loginbtn btn rounded-pill form-control" type="submit" value="Submit Order">
                </div>
                
            </form>
        </div>
        <div class="col-3"></div>
    </div>
    <br><hr/> <!-- Please don't delete this line! -->
        <div id="footer">
            &copy;2024Copyright:DoubleJ.com
        </div>
        <script>
    // Function to retrieve food details from local storage
    function getFoodDetailsFromLocalStorage() {
        // Retrieve food details from local storage
        var foodDetails = JSON.parse(localStorage.getItem('cart'));

        // Check if food details exist in local storage
        if (foodDetails && foodDetails.length > 0) {
            // Set the value of the hidden input field
            document.getElementById('food_details').value = JSON.stringify(foodDetails);
        }
    }

    // Call the function when the page loads
    window.onload = function() {
        getFoodDetailsFromLocalStorage();
    };

    function clearLocalStorage() {
        localStorage.clear();
    }

    function handleFormSubmission() {
        // Clear local storage after successful submission
        clearLocalStorage();
    }
</script>
</body>
</html>

