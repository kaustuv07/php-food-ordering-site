<?php include("partials-frontend/menu.php"); ?>

<style>
    /* Additional CSS to style the delivered row */
    .green-row {
        background-color: #0dd148; /* Green background color */
    }
</style>

<script>
    // JavaScript function to toggle row color and update status
    function toggleRowColorAndStatus(rowId, orderId) {
        var row = document.getElementById(rowId);
        row.classList.toggle('green-row');

        // AJAX request to update order status
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update-order-status.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Update status in UI or handle response if needed
                console.log(xhr.responseText); // Log response for debugging
            }
        };
        xhr.send("order_id=" + orderId);
    }
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

<div style="background-color:#74b659; padding: 20px; overflow-x: auto;">
    <h1 style="margin: 4%; font-size: 40px; text-align: center;">My Orders</h1>

    <div style="text-align: center;">
        <?php
        if (isset($_SESSION['update'])) {
            echo '' . $_SESSION['update'] . '';
            unset($_SESSION['update']);
        }
        ?>
    </div>

    <table id="ordersTable" style="width: 100%; background-color: white; border: 1px solid black; border-collapse: collapse; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <thead style="text-align: left; font-size: 18px; background-color: #f2f2f2;">
            <tr>
                <th scope="col" style='border: 1px solid #000; padding: 10px;'>Order Date</th>
                <th scope="col" style='border: 1px solid #000; padding: 10px;'>Food Item</th>
                <th scope="col" style='border: 1px solid #000; padding: 10px;'>Price (Rs)</th>
                <th scope="col" style='border: 1px solid #000; padding: 10px;'>Quantity</th>
                <th scope="col" style='border: 1px solid #000; padding: 10px;'>Total (Rs)</th>
                <th scope="col" style='border: 1px solid #000; padding: 10px;'>Username</th>
                <th scope="col" style='border: 1px solid #000; padding: 10px;'>Status</th>
                <th scope="col" style='border: 1px solid #000; padding: 10px;text-align:center;'>Click After<br>Delivery</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM ordertable 
        INNER JOIN food ON
        food.food_id = ordertable.food_id
        INNER JOIN customerdetails ON
        customerdetails.cus_id = ordertable.cus_id
        ORDER BY date DESC";
            $res = mysqli_query($conn, $sql);

            if ($res == TRUE) {
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    while ($row = mysqli_fetch_array($res)) {
                        $order_id = $row["order_id"];
                        $orderstatus = $row["orderstatus"];
                        $amount = $row["amount"];
                        $date = $row["date"];
                        $quantity = $row["quantity"];
                        $foodname = $row["foodname"];
                        $username = $row["username"];
                        $cus_address = $row["cus_address"];
                        $cus_mobile = $row["cus_mobile"];
                        $cost = $row["cost"];

                        // Additional class for delivered orders
                        $statusClass = ($orderstatus == 'Delivered') ? 'green-row' : '';

            ?>
                        <tr id="row_<?php echo $order_id; ?>" class="<?php echo $statusClass; ?>">
                            <td style="border: 1px solid #000; padding: 10px;"><b><?php echo $date; ?></b></td>
                            <td style="border: 1px solid #000; padding: 10px;"><?php echo $foodname; ?></td>
                            <td style="border: 1px solid #000; padding: 10px;">Rs. <?php echo $cost; ?></td>
                            <td style="border: 1px solid #000; padding: 10px;"><?php echo $quantity; ?></td>
                            <td style="border: 1px solid #000; padding: 10px;"><b>Rs. <?php echo $amount; ?></b></td>
                            <td style="border: 1px solid #000; padding: 10px;"><?php echo $username; ?></td>
                            <td style="border: 1px solid #000; padding: 10px;"><?php echo $orderstatus; ?></td>
                            <td style="border: 1px solid #000; padding: 10px;text-align:center;"><img src="css/images/tick.png" style="width:30px;height:30px;cursor:pointer;" onclick="toggleRowColorAndStatus('row_<?php echo $order_id; ?>', '<?php echo $order_id; ?>');" /></td> <!-- Added tick symbol -->
                        </tr>
            <?php
                    }
                } else {
            ?>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 10px;">No orders found.</td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>

</div>

<?php include("partials-frontend/footer.php"); ?>
