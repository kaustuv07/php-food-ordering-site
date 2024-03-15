<?php
session_start();

// Check if the item ID is provided and sanitize it
if(isset($_POST['item_id'])) {
    $itemId = filter_var($_POST['item_id'], FILTER_SANITIZE_NUMBER_INT);

    // Check if the cart items are set in the session
    if(isset($_SESSION['cart_items'])) {
        $cartItems = $_SESSION['cart_items'];

        // Check if the item exists in the cart
        if(isset($cartItems[$itemId])) {
            // Remove the item from the cart
            unset($cartItems[$itemId]);

            // Update the session variable
            $_SESSION['cart_items'] = $cartItems;

            // Return success response
            echo json_encode(array('status' => 'success', 'message' => 'Item removed from cart.'));
            exit(); // Exit the script after sending the success response
        } else {
            // Return error response if the item doesn't exist in the cart
            echo json_encode(array('status' => 'error', 'message' => 'Item not found in cart.'));
        }
    } else {
        // Return error response if the cart is empty
        echo json_encode(array('status' => 'error', 'message' => 'Cart is empty.'));
    }
} else {
    // Return error response if item ID is not provided
    echo json_encode(array('status' => 'error', 'message' => 'Item ID not provided.'));
}