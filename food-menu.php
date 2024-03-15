<?php include("partials-frontend/menu.php");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.add-to-cart-btn').click(function() {
        var itemId = $(this).attr('data-item-id');
        $.ajax({
            url: 'add-to-cart.php',
            type: 'post',
            data: { item_id: itemId },
            success: function(response) {
                alert('Item added to cart');
            },
            error: function(xhr, status, error) {
                alert('An error occurred while adding the item to cart');
            }
        });
    });
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

<div style="max-width: 1200px; margin: 20px auto; padding: 0 20px; display: flex; justify-content: space-between;">
    <!-- Menu title -->
    <h1 style="font-family: Arial, sans-serif; color: #333; margin-bottom: 20px;">Menu</h1>

    <!-- Filter options on the right -->
    <div style="flex: 0 0 200px; margin-left: 20px;">
        <h3 style="font-family: Arial, sans-serif; color: #333; margin-bottom: 10px;">Filter:</h3>
        <select id="filter" style="padding: 8px; border-radius: 5px; font-size: 16px; width: 100%;">
            <option value="all">All</option>
            <option value="veg">Vegetarian</option>
            <option value="non_veg">Non-Vegetarian</option>
            <option value="drinks">Drinks</option>
        </select>
    </div>
</div>

<!-- Menu items in grid type structure -->
<div style="max-width: 1100px; margin: 0 auto; display: grid; grid-template-columns: repeat(3, 1fr); grid-gap: 40px;">
    <?php
    // Query to fetch menu items from the database
    $query = "SELECT * FROM food ORDER BY ca_id ";
    $result = mysqli_query($conn, $query);

    // Loop through the fetched menu items
    while ($row = mysqli_fetch_assoc($result)) {
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
    ?>
</div>






<?php include("partials-frontend/footer.php"); ?>