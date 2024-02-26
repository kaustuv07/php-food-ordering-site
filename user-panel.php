<?php include("partials-frontend/menu.php"); ?>
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

<?php
$username = $_SESSION['user'];
$sql = "SELECT * FROM logintable
          INNER JOIN customerdetails ON
          logintable.username = customerdetails.username
          WHERE customerdetails.username = '$username'";
$res = mysqli_query($conn, $sql);

if ($res == true) {
  $count = mysqli_num_rows($res);
  if ($count == 1) {
    $row = mysqli_fetch_assoc($res);
    $cus_name = $row["cus_name"];
    $cus_mobile = $row["cus_mobile"];
    $cus_email = $row["cus_email"];
    $cus_address = $row["cus_address"];

  } else {
    header("location:" . SITEURL . "index.php");
  }
}
?>

<div
  style="background-color:#74b659;padding:80px;display: grid; grid-template-columns: auto auto; grid-gap: 20px; justify-content: flex-start;">
  <div>
    <h1>
      <?php
      if (isset($_SESSION["delete"])) {
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
      }
      if (isset($_SESSION['change'])) {
        echo $_SESSION['change'];
        unset($_SESSION['change']);
      }
      if (isset($_SESSION['update'])) {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
      }
      ?>
    </h1>
    <h1 style="margin: 0; margin-bottom: 10px;">Username :</h1>
    <h1 style="margin: 0; margin-bottom: 10px;">Full Name :</h1>
    <h1 style="margin: 0; margin-bottom: 10px;">Phone No. :</h1>
    <h1 style="margin: 0; margin-bottom: 10px;">Email :</h1>
    <h1 style="margin: 0; margin-bottom: 10px;">Address :</h1>
  </div>

  <div style="display: flex; flex-direction: column;">
    <h1 style="margin: 0; margin-bottom: 10px;">
      <?php echo $_SESSION['user']; ?>
    </h1>
    <h1 style="margin: 0; margin-bottom: 10px;">
      <?php echo $cus_name; ?>
    </h1>
    <h1 style="margin: 0; margin-bottom: 10px;">
      <?php echo $cus_mobile; ?>
    </h1>
    <h1 style="margin: 0; margin-bottom: 10px;">
      <?php echo $cus_email; ?>
    </h1>
    <h1 style="margin: 0; margin-bottom: 10px;">
      <?php echo $cus_address; ?>
    </h1>
    <div style="display: flex; flex-wrap: wrap;">
      <a href="<?php echo SITEURL; ?>order-user.php?username=<?php echo $username; ?>" target="_self"
        style="display: inline-block; padding: 10px 20px; background-color: #ffffff; color: #333333; text-decoration: none; border: none; border-radius: 5px; margin-right: 10px; margin-bottom: 10px;">My
        Orders</a>
      <a href="<?php echo SITEURL; ?>password-user.php?username=<?php echo $username; ?>" target="_self"
        style="display: inline-block; padding: 10px 20px; background-color: #ffffff; color: #333333; text-decoration: none; border: none; border-radius: 5px; margin-right: 10px; margin-bottom: 10px;">Change
        Password</a>
      <a href="<?php echo SITEURL; ?>update-user.php?username=<?php echo $username; ?>" target="_self"
        style="display: inline-block; padding: 10px 20px; background-color: #ffffff; color: #333333; text-decoration: none; border: none; border-radius: 5px; margin-right: 10px; margin-bottom: 10px;">Update
        Details</a>
      <a href="<?php echo SITEURL; ?>delete-user.php?username=<?php echo $username; ?>" target="_self"
        style="display: inline-block; padding: 10px 20px; background-color: #ffffff; color: #333333; text-decoration: none; border: none; border-radius: 5px; margin-right: 10px; margin-bottom: 10px;">Delete
        Account</a>
    </div>
  </div>
</div>






<?php include("partials-frontend/footer.php"); ?>