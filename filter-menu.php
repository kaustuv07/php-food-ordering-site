<?php
// Include your database connection
include("config/constants.php");

// Check if the category is set and not empty
if(isset($_POST['category']) && $_POST['category'] === 'All') {
    $category = $_POST['category'];

    // Query to fetch menu items based on the selected category
    $query = "SELECT * FROM food ORder by food.ca_id";
    $result = mysqli_query($conn, $query);

    // Output filtered menu items
    while ($row = mysqli_fetch_assoc($result)) {
        // Output menu items in the same format as before
        // Modify this according to your HTML structure
        echo '<div class="menu-item" style="border: 1px solid #ccc; border-radius: 8px; overflow: hidden;">';
        echo '<img src="http://localhost/SnackPack/css/images/food/' . $row['image_name'] . '" alt="' . $row['foodname'] . '" style="width: 100%; height: 325px; object-fit: cover;">';
        echo '<div class="menu-item-details" style="padding: 20px; text-align: center;">';
        echo '<h2 style="margin-top: 0; font-family: Arial, sans-serif; color: #333;">' . $row['foodname'] . '</h2>';
        echo '<p style="color: #666;">' . $row['description'] . '</p>';
        echo '<p style="font-weight: bold; color: #333;">Price: Rs. ' . $row['cost'] . '</p>';
        echo '<button class="add-to-cart-btn" data-item-id="' . $row['food_id'] . '" style="padding: 10px 20px; background-color: #4CAF50; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Add to Cart</button>';
        echo '</div>';
        echo '</div>';
    }
}else if(isset($_POST['category']) && !empty($_POST['category'])) {
    $category = $_POST['category'];

    // Query to fetch menu items based on the selected category
    $query = "SELECT * FROM food inner join category on
              food.ca_id = category.ca_id
              WHERE category = '$category' ORDER BY food.ca_id";
    $result = mysqli_query($conn, $query);

    // Output filtered menu items
    while ($row = mysqli_fetch_assoc($result)) {
        // Output menu items in the same format as before
        // Modify this according to your HTML structure
        echo '<div class="menu-item" style="border: 1px solid #ccc; border-radius: 8px; overflow: hidden;">';
        echo '<img src="http://localhost/SnackPack/css/images/food/' . $row['image_name'] . '" alt="' . $row['foodname'] . '" style="width: 100%; height: 325px; object-fit: cover;">';
        echo '<div class="menu-item-details" style="padding: 20px; text-align: center;">';
        echo '<h2 style="margin-top: 0; font-family: Arial, sans-serif; color: #333;">' . $row['foodname'] . '</h2>';
        echo '<p style="color: #666;">' . $row['description'] . '</p>';
        echo '<p style="font-weight: bold; color: #333;">Price: Rs. ' . $row['cost'] . '</p>';
        echo '<button class="add-to-cart-btn" data-item-id="' . $row['food_id'] . '" style="padding: 10px 20px; background-color: #4CAF50; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Add to Cart</button>';
        echo '</div>';
        echo '</div>';
    }
}