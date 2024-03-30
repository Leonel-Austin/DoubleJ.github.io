<?php 
session_start();
require("./check_login.php");
include "../database/connect.php";
require("./header.php");

?>
<style>
    .cart-item {
        border: 1px solid #dee2e6;
        margin-bottom: 10px;
        padding: 20px;
    }
    .cart-item img {
        max-width: 100px;
        max-height: 100px;
    }
    .cart-item-details {
        display: flex;
        align-items: center;
        justify-content: space-around;
    }
    .cart-item-details p {
        margin: 0;
        text-align: center;
    }

    .cart-item-details h5{
        color: #000;
        font-size: 15px;
        width: 300px;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100px;
    }

    .quantity-control button {
        background-color: #f8f9fa;
        border: none;
        cursor: pointer;
        font-size: 16px;
        padding: 5px 10px;
    }
    #priceUI {
        display: flex;
        justify-content: space-around;
    }
    #totalPrice, .totalPrice {
        font-size: 18px;
        font-weight: bold;
        margin-top: 10px;
    }
    .remove-button {
        background-color: red;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        padding: 5px 10px;
    }
</style>

<body class="bg-white">
    
<div class="bg-white container-fluid">
    
    <div class="mt-5">
        <div style="margin-top: 100px;">
            <h2 class="my-4 text-center text-dark">Shopping Cart</h2>
            <p id="cart" class="text-center"></p>
            <div id="clearUI" class="row">
                <div id="cartItems" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 g-4">
                    <!-- Cart items will be added here dynamically -->
                </div>
                
            </div>
            <div id="priceUI" class="justify-content-end me-5">
                <span id="totalPrice"></span>
            </div>
            <div class="d-flex bg-white justify-content-end me-5 checkout" id="checkoutBtn">
            
                <div class="mt-3">
                    <a href="index.php" class="btn btn-primary bg-dark border border-1 border-secondary mb-4">Back</a>
                    <a href="submit_order.php" class="btn btn-primary mb-4">Checkout</a>
                </div>
            </div>  
        </div>
    </div>
    
</div>
</body>

<!-- Footer -->
<?php require("./footer.php"); ?>
<!-- Footer End -->

<!-- Bootstrap Bundle with Popper -->
<script>
    var cartItems = JSON.parse(localStorage.getItem('cart')) || [];
    var container = document.getElementById('cartItems');
    var totalPriceDisplay = document.getElementById('totalPrice');
    var totalPrice = 0;

    function updateTotalPrice() {
        totalPrice = 0;
        cartItems.forEach(function(item) {
            item.totalPrice = item.quantity * item.price;
            totalPrice += item.totalPrice;
        });
        totalPriceDisplay.textContent = 'Total Price: MMK ' + totalPrice.toFixed(2);
    }

    function updateCartUI() {
        container.innerHTML = '';
        if (cartItems.length === 0) {
            document.getElementById('clearUI').innerHTML = '';
            document.getElementById('cart').innerHTML = 'No items in the cart.';
            document.getElementById('priceUI').innerHTML = '';
            document.getElementById('checkoutBtn').innerHTML = '';
        } else {
            cartItems.forEach(function(item) {
                var div = document.createElement('div');
                div.classList.add('cart-item');

                var detailsDiv = document.createElement('div');
                detailsDiv.classList.add('cart-item-details');

                var img = document.createElement('img');
                img.src = '../../../images/' + item.photo;
                img.alt = item.food_name;

                var h5 = document.createElement('h5');
                h5.textContent = item.food_name;

                var priceP = document.createElement('p');
                priceP.textContent = 'MMK ' + item.totalPrice.toFixed(2);

                var quantityDiv = document.createElement('div');
                quantityDiv.classList.add('quantity-control');

                var minusBtn = document.createElement('button');
                minusBtn.textContent = '-';
                minusBtn.addEventListener('click', function() {
                    item.quantity--;
                    item.totalPrice -= item.price;

                    if (item.quantity <= 0) {
                        removeFromCart(item);
                    }
                    updateCartUI();
                    updateLocalStorage();
                    updateTotalPrice();
                    updateCartBadge()
                });

                var quantityP = document.createElement('p');
                quantityP.textContent = item.quantity;

                var plusBtn = document.createElement('button');
                plusBtn.textContent = '+';
                plusBtn.addEventListener('click', function() {
                    item.quantity++;
                    item.totalPrice += item.price;

                    updateCartUI();
                    updateLocalStorage();
                    updateTotalPrice();
                    updateCartBadge()
                });

                var removeBtn = document.createElement('button');
                removeBtn.textContent = 'Remove';
                removeBtn.classList.add('remove-button'); // Add a class for styling
                removeBtn.addEventListener('click', function() {
                    removeFromCart(item);
                    updateCartUI();
                    updateLocalStorage();
                    updateTotalPrice();
                });

                quantityDiv.appendChild(minusBtn);
                quantityDiv.appendChild(quantityP);
                quantityDiv.appendChild(plusBtn);

                detailsDiv.appendChild(img);
                detailsDiv.appendChild(h5);
                detailsDiv.appendChild(quantityDiv);
                detailsDiv.appendChild(priceP);
                detailsDiv.appendChild(removeBtn);

                div.appendChild(detailsDiv);
                container.appendChild(div);
            });
        }
    }
    updateCartUI();
    updateTotalPrice();
    function removeFromCart(item) {
        cartItems = cartItems.filter(function(cartItem) {
            return cartItem.food_id !== item.food_id;
        });
        localStorage.setItem('cart_count', localStorage.getItem('cart_count') - item.quantity);
        // Update cart count badge in header
        let cartCount = localStorage.getItem('cart_count');
        // Update cart count badge in header
        document.querySelector('.cart-count-badge').textContent = cartCount;

        updateLocalStorage();
    }

    function updateLocalStorage() {
        localStorage.setItem('cart', JSON.stringify(cartItems));

        var cartCount = cartItems.reduce((total, item) => total + item.quantity, 0);
        localStorage.setItem('cart_count', cartCount);
    }

    
    function updateCartBadge() {
        let cartCount = localStorage.getItem('cart_count') || 0;
        document.querySelector('.cart-count-badge').textContent = cartCount;
    }

    function updateCartCount() {
        var cartItems = JSON.parse(localStorage.getItem('cart')) || [];

        var cartCount = cartItems.reduce(function(total, item) {
            return total + item.quantity;
        }, 0);

        document.getElementById('cart-count').innerText = cartCount;
    }

    // Call the function to update cart count badge
    updateCartBadge();
</script>

