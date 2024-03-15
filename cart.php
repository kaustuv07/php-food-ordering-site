<?php include("partials-frontend/menu.php");

if (isset($_SESSION['cart_items'])) {
    $cartItems = $_SESSION['cart_items'];
} else {
    $cartItems = array(); // Initialize an empty array if no items are set
}

$sql = "SELECT * FROM food WHERE ca_id=3 LIMIT 3;";
$result = $conn->query($sql);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('.add-to-cart-btn').click(function () {
            var itemId = $(this).attr('data-item-id');
            $.ajax({
                url: 'add-to-cart.php',
                type: 'post',
                data: { item_id: itemId },
                success: function (response) {
                    if (response === 'success') {
                        // Item added successfully, update the cart content
                        updateCartContent();
                        alert('Item added to cart');
                    } else {
                        alert('An error occurred while adding the item to cart');
                    }
                },
                error: function (xhr, status, error) {
                    alert('An error occurred while adding the item to cart');
                }
            });
        });

        $(document).on('click', '.remove-from-cart-btn', function () {
            var itemId = $(this).attr('data-item-id');
            $.ajax({
                url: 'remove-from-cart.php',
                type: 'post',
                data: { item_id: itemId },
                dataType: 'json', // Specify the expected data type for the response
                success: function (response) {
                    if (response.status === 'success') {
                        // Item removed successfully, update the cart content
                        updateCartContent();
                        alert(response.message); // Display success message from the server
                    } else {
                        // Display error message from the server
                        alert(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    // Display generic error message
                    alert('An error occurred while removing the item from cart');
                }
            });
        });


        // Function to update the cart content
        function updateCartContent() {
            $.ajax({
                url: 'get-cart-content.php', // Replace with the actual path to get_cart_content.php
                type: 'get',
                success: function (data) {
                    $('.cart-content').html(data); // Update the cart content
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching cart content');
                }
            });
        }
    });
</script>
<div id="header" style="background-color:black;">
    <div class="container">
        <nav>
            <!-- LOGO -->
            <img class="page-logo" src="./css/images/logo.png" alt="SnackPack Logo" />
            <!-- HOME,ABOUT -->
            <?php include("partials-frontend/nav-bar.php"); ?>
            <!-- LOGIN BUTTON -->
            <ul>
                <li><b>
                        <?php if (isset($_SESSION["user"])) {
                            ?>
                            <a href="user-panel.php" style="font-size: 25px;color: rgb(0, 217, 0);">
                                <?php echo $_SESSION['user']; ?>
                            </a>
                        </b></li>
                    <li><b>
                            <a href="logout.php" style="color:red;margin-left: 125%;font-size:20px;">LogOut</a>
                            <?php
                        } else {
                            ?> <a href="<?php echo SITEURL; ?>login.php" id="profileName" name="profileName"
                                style="font-size: 25px;color: rgb(0, 217, 0);">Log In</a>
                            <?php
                        }
                        ?>
                    </b>
                </li>
            </ul>
        </nav>
    </div>
</div>
</div>

<div class="container"
    style="max-width: 800px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <h1 style="text-align: center; color: #333; font-size: 28px;">Your Cart</h1>
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr style="background-color: #f8f8f8;">
            <th style="padding: 15px; border-bottom: 1px solid #ddd; text-align: left; font-size: 20px;">Item</th>
            <th style="padding: 15px; border-bottom: 1px solid #ddd; text-align: left; font-size: 20px;">Price (Rs.)
            </th>
            <th style="padding: 15px; border-bottom: 1px solid #ddd; text-align: left; font-size: 20px;">Quantity</th>
            <th style="padding: 15px; border-bottom: 1px solid #ddd; text-align: left; font-size: 20px;">Total (Rs.)
            </th>
            <th style="padding: 15px; border-bottom: 1px solid #ddd; text-align: left; font-size: 20px;">Actions</th>
        </tr>
        <!-- Loop through cart items -->
        <?php
        $totalPrice = 0; // Initialize total price
        if (!empty($cartItems)) {
            foreach ($cartItems as $key => $item) {
                // Calculate total price for each item
                $itemTotal = $item['quantity'] * $item['cost'];
                $totalPrice += $itemTotal; // Add to total price
        
                // Output table row for each item
                echo '<tr>';
                echo '<td style="padding: 15px; border-bottom: 1px solid #ddd; text-align: left; font-size: 18px;">' . $item['foodname'] . '</td>';
                echo '<td style="padding: 15px; border-bottom: 1px solid #ddd; text-align: left; font-size: 18px;">Rs. ' . $item['cost'] . '</td>';
                echo '<td style="padding: 15px; border-bottom: 1px solid #ddd; text-align: left; font-size: 18px;">' . $item['quantity'] . '</td>';
                echo '<td style="padding: 15px; border-bottom: 1px solid #ddd; text-align: left; font-size: 18px;">Rs. ' . $itemTotal . '</td>';
                echo '<td style="padding: 15px; border-bottom: 1px solid #ddd; text-align: center; font-size: 18px;"><button class="remove-from-cart-btn" data-item-id="' . $key . '" style="background: none; border: none;"><i class="fas fa-times-circle" style="color: red; font-size: 24px;"></i></button></td>'; // Add Remove button with data-item-id attribute
                echo '</tr>';
            }
        } else {
            echo '<tr><td style="text-align:center;">Your cart is empty.</td></tr>';
        }
        ?>
        <!-- Total row -->
        <tr>
            <td colspan="3" class="total"
                style="padding: 15px; font-size: 1.2em; font-weight: bold; text-align: right; font-size: 20px;">Total:
            </td>
            <td class="total"
                style="padding: 15px; font-size: 1.2em; font-weight: bold; text-align: left; font-size: 20px;">Rs.
                <?php echo $totalPrice; ?>
            </td>
        </tr>
    </table>

    <div class="payment-options" style="text-align: center;">
        <h2 style="margin-bottom: 20px; color: #333;">Select Payment Method:</h2>

        <input type="radio" id="paypal" name="payment_method" value="paypal" style="margin: 0 10px;">
        <label for="paypal" style="font-weight: bold; color: #333;">E-sewa</label>

        <input type="radio" id="cash_on_delivery" name="payment_method" value="cash_on_delivery"
            style="margin: 0 10px;">
        <label for="cash_on_delivery" style="font-weight: bold; color: #333;">Cash on Delivery</label>
    </div>
    <br />
    <div id="checkoutButtonContainer" style="text-align: center;">
        <button id="checkoutButton"
            style="font-size:20px;padding: 12px 24px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer; display: block; margin: 0 auto;">Proceed
            to Checkout</button>
    </div>

    <script>
        // Get checkout button and payment method radio buttons
        var checkoutButton = document.getElementById('checkoutButton');
        var paymentMethodRadios = document.getElementsByName('payment_method');

        // Add click event listener to checkout button
        checkoutButton.addEventListener('click', function (event) {
            var selectedPaymentMethod;
            // Loop through payment method radio buttons to find the selected one
            for (var i = 0; i < paymentMethodRadios.length; i++) {
                if (paymentMethodRadios[i].checked) {
                    selectedPaymentMethod = paymentMethodRadios[i].value;
                    break;
                }
            }
            // Check if a payment method is selected
            if (selectedPaymentMethod) {
                // Prevent the default action of the button
                event.preventDefault();
                // Append selected payment method to the URL and redirect to checkout page
                var checkoutUrl = "<?php echo SITEURL; ?>checkout.php?payment_method=" + encodeURIComponent(selectedPaymentMethod) + "&total_price=" + encodeURIComponent(<?php echo $totalPrice; ?>);

                $.ajax({
                    url: 'place-order.php', // Replace with the actual path to add-order.php
                    type: 'post',
                    data: {
                        payment_method: selectedPaymentMethod,
                        total_price: <?php echo $totalPrice; ?>,
                        cart_items: <?php echo json_encode($cartItems); ?>, // Assuming $cartItems contains the details of items in the cart
                        orderstatus: 'pending', // Example order status
                        food_id: <?php echo $food_id; ?>, // Example food id
                        amount: <?php echo $totalPrice; ?>, // Example amount
                        date: '<?php echo date("Y-m-d H:i:s"); ?>', // Current date and time
                        cus_id: <?php echo $cus_id; ?>, // Example customer id
                        quantity: <?php echo $quantity; ?>, // Example quantity
                        custom_status: 'Processing' // Example custom status
                    },
                    success: function (response) {
                        // Redirect to checkout page after successfully adding order
                        window.location.href = checkoutUrl;
                    },
                    error: function (xhr, status, error) {
                        // Display error message if adding order fails
                        alert('An error occurred while adding the order');
                    }
                });

            } else {
                // If no payment method is selected, display an alert
                alert("Please select a payment method");
            }
        });
    </script>


    <div class="recommendations"
        style="max-width: 800px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h2 style="text-align: center; color: #333;">Recommended Additions</h2>

        <!-- Loop through recommended products and display them -->
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">';
                echo '<div>';
                echo '<h3 style="margin: 0;">' . $row["foodname"] . '</h3>';
                echo '<p style="margin: 0; color: #888;">' . $row["description"] . '</p>';
                echo '<p style="margin: 0; font-weight: bold;">Rs. ' . $row["cost"] . '</p>';
                echo '</div>';
                echo '<button class="add-to-cart-btn" data-item-id="' . $row['food_id'] . '" style="padding: 10px 20px; background-color: #4CAF50; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Add to Cart</button>';
                echo '</div>';
            }
        } else {
            echo '<p>No recommended products available.</p>';
        }
        ?>
    </div>
</div>

    <?php include("partials-frontend/footer.php"); ?>