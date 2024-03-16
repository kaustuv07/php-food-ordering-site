<?php include("config/constants.php");

// Check if the item ID is provided
if (isset($_POST['item_id'])) {
    // Get the item ID
    $item_id = $_POST['item_id'];

    // Check if the cart session variable exists, if not, initialize it
    if (!isset($_SESSION['cart_items'])) {
        $_SESSION['cart_items'] = array();
    }

    // Check if the item is already in the cart
    $item_index = array_search($item_id, array_column($_SESSION['cart_items'], 'food_id'));

    // If item is already in the cart, increase its quantity
    if ($item_index !== false) {
        $_SESSION['cart_items'][$item_index]['quantity'] += 1;
    } else {
        // Fetch item details from the database and add it to the cart session variable
        // Replace this part with your actual database query to fetch item details
        // Query to fetch item details from the database based on item_id
        $sql = "SELECT * FROM food WHERE food_id = $item_id";
        $result = $conn->query($sql);

        // If item details are found, add it to the cart session variable
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $item_details = array(
                'food_id' => $row['food_id'],
                'foodname' => $row['foodname'],
                'cost' => $row['cost'],
                'quantity' => 1 // Set default quantity to 1
            );
            $_SESSION['cart_items'][] = $item_details;
        } else {
            // Item not found in the database
            die("Item not found in the database.");
        }

        // Close the database connection
        $conn->close();
    }

    // Return success response
    echo 'success';
} else {
    // Return error response
    echo 'error';
}
