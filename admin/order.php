<?php include("partials/menu.php"); ?>

<h1 style="margin-left: 1%;">Orders History</h1>

<div style="text-align:center;">
  <?php
    if(isset($_SESSION['update']))
    {
      echo''.$_SESSION['update'].'';
      unset($_SESSION['update']);
    }
  ?>
</div>

<style>
  .break-line {
    word-wrap: break-word;
    white-space: normal; /* Allow wrapping to new line */
  }

  .time {
    font-weight: bold;
  }
</style>

<table class="table table-success table-striped" style="margin: 1%;width: 98%;">
<a href="pending-order.php" target="_self" style="text-decoration: none; color: inherit;">
<button type="button" class="btn btn-danger" style="margin-left:1%;background-color:orange;border-color:orange;">Pending Orders</button></a>
<a href="completed-order.php" target="_self" style="text-decoration: none; color: inherit;">
<button type="button" class="btn btn-success" style="margin-left:1%;">Completed Orders</button></a>
  <thead >
    <tr>
      <th scope="col">Ordered Time</th>
      <th scope="col">Food Items</th>
      <th scope="col">Quantities</th>
      <th scope="col">Total Price</th>
      <th scope="col">Username</th>
      <th scope="col">Phone No.</th>
      <th scope="col">Address</th>
      <th scope="col">Status</th>
      <th scope="col">Custom Status</th>
      <th scope="col">Payment Method</th>
    </tr>
  </thead>
  <tbody>
  <?php
            $sql = "SELECT
                        GROUP_CONCAT(food.foodname SEPARATOR ', ') AS food_items,
                        GROUP_CONCAT(ordertable.quantity SEPARATOR ', ') AS quantities,
                        SUM(ordertable.amount) AS total_price,
                        ordertable.date AS order_date,
                        customerdetails.username AS username,
                        customerdetails.cus_mobile AS phone_no,
                        customerdetails.cus_address AS address,
                        ordertable.orderstatus AS status,
                        ordertable.custom_status AS custom_status,
                        ordertable.payment_method AS payment_method
                    FROM
                        ordertable
                    INNER JOIN food ON
                        food.food_id = ordertable.food_id
                    INNER JOIN customerdetails ON
                        customerdetails.cus_id = ordertable.cus_id
                    GROUP BY
                        ordertable.date,
                        customerdetails.username,
                        customerdetails.cus_mobile,
                        customerdetails.cus_address,
                        ordertable.orderstatus,
                        ordertable.custom_status,
                        ordertable.payment_method
                    ORDER BY
                        ordertable.date DESC;
            ";
            $res = mysqli_query($conn,$sql);

            if($res==TRUE)
            {
              $count = mysqli_num_rows($res);
              if($count> 0)
              {
                while($row = mysqli_fetch_array($res))
                {
                  $order_date = $row["order_date"];
                  $time = date("g:i A", strtotime($order_date)); // Convert to 12-hour format
                  $date = date("M j, Y", strtotime($order_date)); // Convert to desired date format
                  $food_items = $row["food_items"];
                  $quantities = $row["quantities"];
                  $total_price = $row["total_price"];
                  $username = $row["username"];
                  $phone_no = $row["phone_no"];
                  $address = $row["address"];
                  $status = $row["status"];
                  $custom_status = $row["custom_status"];
                  $payment_method = $row["payment_method"];
                  ?>
                <tr> 
                  <td class="break-line">
                    <span class="time"><?php echo $time;?></span><br><?php echo $date;?>
                  </td>
                  <td class="break-line"><?php echo $food_items;?></td>
                  <td class="break-line"><?php echo $quantities;?></td>
                  <td class="break-line">Rs. <?php echo $total_price;?></td>
                  <td class="break-line"><?php echo $username;?></td>
                  <td class="break-line"><?php echo $phone_no;?></td>
                  <td class="break-line"><?php echo $address;?></td>
                  <td class="break-line"><?php echo $status;?></td>
                  <td class="break-line"><?php echo $custom_status;?></td>
                  <td class="break-line"><?php echo $payment_method;?></td>
                </tr>
                <?php
            }
          }else{

          }
          }
        ?>
  </tbody>
</table>
<?php include("partials/footer.php"); ?>
