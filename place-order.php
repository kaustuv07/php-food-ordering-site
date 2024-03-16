<?php
include ("config/constants.php");

if (isset($_SESSION['cart_items'])) {
    $cartItems = $_SESSION['cart_items'];
} else {
    $cartItems = array(); // Initialize an empty array if no items are set
}

// Check if the request is made via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from AJAX request
    $payment_method = $_POST['payment_method'];
    $orderstatus = "On Queue";
    date_default_timezone_set('Asia/Kathmandu');
    $date = date("Y-m-d H:i:s");
    $custom_status = "Processing..";

    $username = $_SESSION['user'];
    $sql = "SELECT * FROM logintable INNER JOIN customerdetails
                        ON logintable.username = customerdetails.username
                        WHERE logintable.username='$username'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            while ($row = mysqli_fetch_array($res)) {
                $cus_id = $row["cus_id"];
            }
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    if (!empty($cartItems)) {
        foreach ($cartItems as $key => $item) {
            $food_id = $item['food_id'];
            $quantity = $item['quantity'];
            $cost = $item['cost'];
            $amount = $quantity * $cost;

            $sql = "INSERT INTO ordertable (payment_method, orderstatus, food_id, amount, date, cus_id, quantity, custom_status)
                VALUES ('$payment_method', '$orderstatus', '$food_id', '$amount', '$date', '$cus_id', '$quantity', '$custom_status')";

            if ($conn->query($sql) !== TRUE) {
                // If there's an error in any insertion, output the error
                echo "Error: " . $sql . "<br>" . $conn->error;
                break; // Stop the loop on error
            }
        }

        // If all insertions were successful, output success message
        if (!isset($conn->error)) {
            echo "success";
            if($payment_method === 'Khalti') {
                header("Location: order-user.php");
            }
        }
    } else {
        // If cart is empty, output message
        echo '<tr><td style="text-align:center;">Your cart is empty.</td></tr>';
    }
} else {
    // If the request method is not POST, handle accordingly (e.g., redirect, error response)
    echo "Invalid request method";
}

// Close database connection
$conn->close();