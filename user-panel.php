<?php include("partials-frontend/menu.php"); ?>
      <div id="header"style="background-color:black;">
        <div class="container" >
          <nav>
            <!-- LOGO -->
            <img
              class="page-logo"
              src="./css/images/logo.png"
              alt="SnackPack Logo"
            />
            <!-- HOME,ABOUT -->
            <ul>
              <li><a href="<?php echo SITEURL;?>">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#menu">Menu</a></li>
              <li><a href="<?php echo SITEURL;?>services.php">Services</a></li>
              <li><a href="#contact">Contact</a></li>
              <li>
                <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
              </li>
            </ul>
            <!-- LOGIN BUTTON -->
            <ul>
            <li><b>
                <?php if(isset($_SESSION["user"]))
                {
                ?>
                    <a href="user-panel.php" style="font-size: 25px;color: rgb(0, 217, 0);margin-left:-400%"><?php echo $_SESSION['user']; ?></a>
                    </b></li>
                <li><b>
                    <a href="logout.php" style="color:red;margin-left: 125%;font-size:20px;">LogOut</a>
                <?php
                }else{
                 ?> <a href="<?php echo SITEURL;?>login.php" id = "profileName" name="profileName" style="font-size: 25px;color: rgb(0, 217, 0);">Log In</a>
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

<?php 
  $username = $_SESSION['user'];
  $sql = "SELECT * FROM logintable
          INNER JOIN customerdetails ON
          logintable.username = customerdetails.username
          WHERE customerdetails.username = '$username'";
  $res = mysqli_query($conn, $sql);

  if($res==true)
    {
        $count = mysqli_num_rows($res);
        if($count==1)
        {
            $row = mysqli_fetch_assoc($res);
            $cus_name = $row["cus_name"];
            $cus_mobile = $row["cus_mobile"];
            $cus_email = $row["cus_email"];
            $cus_address = $row["cus_address"];

        }
        else
        {
            header("location:".SITEURL."index.php");
        }
    }
?>

<div>
    <h1 style="margin:2%">Username :  <?php echo $_SESSION['user']; ?></h1>
</div>

<div>
    <h1 style="margin:2%">Legal Name :  <?php echo $cus_name; ?></h1>
</div>

<div>
    <h1 style="margin:2%">Phone No. :  <?php echo $cus_mobile; ?></h1>
</div>

<div>
    <h1 style="margin:2%">Email :  <?php echo $cus_email; ?></h1>
</div>

<div>
    <h1 style="margin:2%">Address :  <?php echo $cus_address; ?></h1>
</div>

<div>
  <a href="<?php echo SITEURL; ?>order-user.php?username=<?php echo $username; ?>" target="_self">
        <button type="button" >My Orders</button>
  <a href="<?php echo SITEURL; ?>password-user.php?username=<?php echo $username; ?>" target="_self">
        <button type="button" >Change Password</button>
  <a href="<?php echo SITEURL; ?>update-user.php?username=<?php echo $username; ?>" target="_self">
        <button type="button" >Update Details</button>
  </a>
  <a href="<?php echo SITEURL; ?>delete-user.php?username=<?php echo $username; ?>" target="_self">
        <button type="button">Delete Account</button>
  </a>
</div>




<?php include("partials-frontend/footer.php"); ?>