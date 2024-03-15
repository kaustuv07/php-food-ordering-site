<?php
include("config/constants.php");

// Check if the request is made via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from AJAX request
    $payment_method = $_POST['payment_method'];
    $total_price = $_POST['total_price'];
    $cart_items = json_decode($_POST['cart_items'], true); // Decode JSON string to PHP array

    // Example: Additional data to be inserted into the database
    $orderstatus = $_POST['orderstatus'];
    $food_id = $_POST['food_id'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $cus_id = $_POST['cus_id'];
    $quantity = $_POST['quantity'];
    $custom_status = $_POST['custom_status'];

    // Insert order into database
    $sql = "INSERT INTO ordertable (payment_method, orderstatus, food_id, amount, date, cus_id, quantity, custom_status)
            VALUES ('$payment_method', '$orderstatus', '$food_id', '$amount', '$date', '$cus_id', '$quantity', '$custom_status')";

    if ($conn->query($sql) === TRUE) {
        // Order successfully inserted
        echo "success";
    } else {
        // Error occurred while inserting order
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // If the request method is not POST, handle accordingly (e.g., redirect, error response)
    echo "Invalid request method";
}

// Close database connection
$conn->close();
