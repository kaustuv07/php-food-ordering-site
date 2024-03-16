<?php
include("config/constants.php"); // Start or resume the session

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
if($payment_method === 'Khalti') {
    // PayPal checkout process
    // Implement PayPal checkout logic here
    header("Location: khalti-gateway/pay.php");
    $message = "Thank you for choosing Khalti. Your order has been successfully placed.";
} elseif ($payment_method === 'cash_on_delivery') {
    // Cash on Delivery checkout process
    // Implement Cash on Delivery checkout logic here
    $message = "Thank you for choosing <b>Cash on Delivery</b>. Your order has been successfully placed. We will contact you shortly.";
} else {
    // If an invalid payment method is selected, redirect back to cart page or any other appropriate page
    header("Location: cart.php");
    exit;
}
// Process user's location (For demonstration, I'll assume a form for location input)
$username = $_SESSION['user'];
$sql = "SELECT * FROM logintable
          INNER JOIN customerdetails ON
          logintable.username = customerdetails.username
          WHERE customerdetails.username = '$username'";
$res = mysqli_query($conn, $sql);

if ($res == true) {
  $count = mysqli_num_rows($res);
  if ($count == 1) {
    $row = mysqli_fetch_assoc($res);
    $cus_name = $row["cus_name"];
    $cus_mobile = $row["cus_mobile"];
    $cus_address = $row["cus_address"];

  } else {
    header("location:" . SITEURL . "index.php");
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['confirmed_address'])) {
        // Update confirmed address in the database
        $confirmed_address = $_POST['confirmed_address'];
        $update_query = "UPDATE customerdetails SET cus_address='$confirmed_address' WHERE username='$username'";
        if ($conn->query($update_query) === TRUE) {
            echo "<p>Your address has been confirmed: " . $confirmed_address . "</p>";
            unset($_SESSION['cart_items']);
            header("location:" . SITEURL . "order-user.php");
            // Optionally, you can redirect the user to another page after updating the address
        } else {
            echo "Error updating address: " . $conn->error;
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Add any necessary stylesheets or scripts here -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 600px;
            width: 100%;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            box-sizing: border-box;
        }

        h1 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #333;
        }

        p {
            font-size: 18px;
            color: #555;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: calc(100% - 22px);
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            margin-bottom: 15px;
            background-color: #f9f9f9;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        input[type="text"]:focus {
            outline: none;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        hr {
            margin: 20px 0;
            border: none;
            border-top: 1px solid #ddd;
        }

        .thank-you {
            text-align: center;
            font-size: 20px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Checkout</h1>
        <div>
            <p><?php echo $message; ?></p>
            <hr>
            <h2>Bill</h2>
            <p>Customer Name: <b><?php echo $cus_name; ?></b></p>
            <p>Contact: <b><?php echo $cus_mobile; ?></b></p>
            <p>Total Price: <b>Rs. <?php echo $totalPrice; ?></b></p>
            <form method="post" action="">
                <p>Delivery Address: <input type="text" name="confirmed_address" value="<?php echo $cus_address; ?>"></p>
                <div><center><button type="submit"name="submit">Confirm Address</button></center></div>
            </form>
            <hr>
            <p class="thank-you">Thank you for eating with us!</p>
        </div>
    </div>
</body>
</html>
