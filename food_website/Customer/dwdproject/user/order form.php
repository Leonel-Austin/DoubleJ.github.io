<!-- order-form.php -->

<?php
// (A) PROCESS ORDER FORM
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $paymentType = $_POST["paymentType"];
    $cardNumber = $_POST["cardNumber"];

    // Save order details to the database (you'll need to implement this part)
    // ...

    // Display a confirmation message
    echo "<div class='notify'>Thank you, $name! Your order has been received.</div>";
}
?>

<!-- ORDER FORM -->
<form method="post" target="_self">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <label for="phone">Phone</label>
    <input type="tel" id="phone" name="phone" required>

    <label for="address">Address</label>
    <textarea id="address" name="address" rows="4" required></textarea>

    <label for="paymentType">Payment Type</label>
    <select id="paymentType" name="paymentType" required>
        <option value="credit">Credit Card</option>
        <option value="paypal">PayPal</option>
        <!-- Add more payment options as needed -->
    </select>

    <label for="cardNumber">Card Number</label>
    <input type="text" id="cardNumber" name="cardNumber" required>

    <input type="submit" value="Place Order">
</form>