<?php
session_start(); // Start or resume the session

// Check if payment method is selected
if(isset($_GET['payment_method'])&& isset($_GET['total_price'])) {
    $payment_method = $_GET['payment_method'];
    $totalPrice = $_GET["total_price"];
} else {
    // If payment method is not selected, redirect back to cart page or any other appropriate page
    header("Location: cart.php");
    exit;
}

// Include any necessary files (e.g., database connection)
// include("db_connection.php");

// Process the checkout based on the selected payment method
if($payment_method === 'paypal') {
    // PayPal checkout process
    // Implement PayPal checkout logic here
    $message = "Thank you for choosing PayPal. Your order has been successfully placed.";
} elseif ($payment_method === 'cash_on_delivery') {
    // Cash on Delivery checkout process
    // Implement Cash on Delivery checkout logic here
    $message = "Thank you for choosing Cash on Delivery. Your order has been successfully placed. We will contact you shortly.";
} else {
    // If an invalid payment method is selected, redirect back to cart page or any other appropriate page
    header("Location: cart.php");
    exit;
}
// Process user's location (For demonstration, I'll assume a form for location input)
$userLocation = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userLocation = $_POST["location"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Add any necessary stylesheets or scripts here -->
</head>
<body>
    <h1>Checkout</h1>
    <div>
        <p><?php echo $message; ?></p>
        <hr>
        <h2>Bill</h2>
        <p>Total Price: Rs. <?php echo $totalPrice; ?></p>
        <!-- Form to collect user's location -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="location">Enter your location:</label>
            <input type="text" id="location" name="location" required>
            <button type="submit">Submit</button>
        </form>
        <?php
        // Display location if submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "<p>Your location: " . $userLocation . "</p>";
        }
        ?>
        <hr>
        <p>Thank you for shopping with us!</p>
    </div>
</body>
</html>
