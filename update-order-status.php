<?php
include("config/constants.php");
// Check if order_id is set in POST request
if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Update order status to "Delivered" in the database
    // Replace this with your database connection and query
    $sql = "UPDATE ordertable SET orderstatus = 'Delivered' WHERE order_id = $order_id";

    // Execute query (assuming $conn is your database connection)
    if (mysqli_query($conn, $sql)) {
        echo "Status updated successfully"; // Return success message
    } else {
        echo "Error updating status: " . mysqli_error($conn); // Return error message
    }
} else {
    echo "Invalid request"; // Return message for invalid request
}