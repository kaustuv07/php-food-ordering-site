<?php
session_start();

// Check if cart items are set in the session
if (isset($_SESSION['cart_items'])) {
    $cartItems = $_SESSION['cart_items'];
} else {
    $cartItems = array(); // Initialize an empty array if no items are set
}

// Output cart items
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
