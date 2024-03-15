<?php include("partials/menu.php"); ?>

<?php
    $order_id =$_GET['order_id'];
    $sql = "SELECT * FROM ordertable 
            INNER JOIN food ON
            food.food_id = ordertable.food_id
            INNER JOIN customerdetails ON
            customerdetails.cus_id = ordertable.cus_id
            WHERE order_id ='$order_id'";
    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $count = mysqli_num_rows($res);
        if($count==1)
        {
            $row = mysqli_fetch_assoc($res);
            $orderstatus =$row["orderstatus"];
            $amount = $row["amount"];
            $date = $row["date"];
            $quantity = $row["quantity"];
            $foodname = $row["foodname"];
            $username = $row["username"];
            $cus_address = $row["cus_address"];
            $cus_mobile = $row["cus_mobile"];
            $cost = $row["cost"];
            $custom_status = $row["custom_status"];
        }
        else
        {
            header("location:".SITEURL."admin/pending-order.php");
        }
    }
    if(isset($_POST["submit"]))
    {
        $order_id = $_POST["order_id"];
        $orderstatus =$_POST["orderstatus"];
        $custom_status =$_POST["custom_status"];

        $sql = "UPDATE ordertable
                SET orderstatus='$orderstatus',
                custom_status='$custom_status'
                WHERE order_id = '$order_id'
                ";
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['update'] = 'Order Updated Successfully';
            header("location:" . SITEURL . "admin/pending-order.php");
        }
        else
        {
            $_SESSION['update'] = 'Failed to update Order';
            header("location:" . SITEURL . "admin/update-order.php");
        }

    }
?>
<h1 style="margin-left: 5%;">Update Order Status</h1>
<div style="text-align:center;">
  <?php
    if(isset($_SESSION['update']))
    {
      echo''.$_SESSION['update'].'';
      unset($_SESSION['update']);
    }
  ?>
</div>
<form action = "" method="POST"enctype="multipart/form-data">

<input type="hidden" name="order_id" value="<?php echo $order_id;?>" required>

  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="foodname" class="form-label">Order Date :     <?php echo $date; ?></label>
  </div>
  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="foodname" class="form-label">Food Name :      <?php echo $foodname; ?></label>
  </div>
  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="foodname" class="form-label">Price :          <?php echo $cost; ?></label>
  </div>
  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="foodname" class="form-label">Quantity :       <?php echo $quantity; ?></label>
  </div>
  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="foodname" class="form-label">Total :          <?php echo $amount; ?></label>
  </div>
  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="foodname" class="form-label">Customer Name :  <?php echo $username; ?></label>
  </div>


  <div class="mb-3" style="max-width: 300px; margin-left: 5%;">
  <label for="orderstatus">Update Status:</label>
  <select id="orderstatus" name="orderstatus">
    <option value="On Queue"name="orderstatus" <?php if($orderstatus == 'On Queue') echo 'selected';?>>On Queue</option>
    <option value="Cooking and Packaging"name="orderstatus" <?php if($orderstatus == 'Cooking and Packaging') echo 'selected';?>>Cooking and Packaging</option>
    <option value="On Delivery"name="orderstatus" <?php if($orderstatus == 'On Delivery') echo 'selected';?>>On Delivery</option>
    <option value="Delivered"name="orderstatus" <?php if($orderstatus == 'On Delivered') echo 'selected';?> >Delivered</option>
    <option value="Cancelled"name="orderstatus" <?php if($orderstatus == 'Cancelled') echo 'selected';?>>Cancelled</option>
  </select>
    </div>

    <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="foodname" class="form-label">Custom status : </label>
    <textarea name="custom_status" cols="30" rows="2" required><?php echo $custom_status ?></textarea>
  </div>

  <button type="submit" class="btn btn-primary"style="margin-left: 5%;margin-bottom:1%;"name="submit">Update Order</button>
</form>
<?php include("partials/footer.php"); ?>

