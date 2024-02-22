<?php include("partials-frontend/menu.php");
$username = $_GET['username'];
$sql = "SELECT * FROM customerdetails WHERE username ='$username'";
$res = mysqli_query($conn, $sql);

if ($res == true) {
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $username = $row["username"];
        $cus_name = $row["cus_name"];
        $cus_email = $row["cus_email"];
        $cus_mobile = $row["cus_mobile"];
        $cus_address = $row["cus_address"];
    } else {
        header("location:" . SITEURL . "user-panel.php");
    }
}

if (isset($_POST["submit"])) {
    $cus_name = $_POST["cus_name"];
    $cus_email = $_POST["cus_email"];
    $cus_mobile = $_POST["cus_mobile"];
    $cus_address = $_POST["cus_address"];

    $sql = "UPDATE customerdetails SET
            cus_name = '$cus_name',
            cus_email = '$cus_email',
            cus_mobile = '$cus_mobile',
            cus_address = '$cus_address'
            WHERE username = '$username'
            ";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['update'] = 'Details updated successfully';
        header("location:" . SITEURL . "user-panel.php");
    } else {
        $_SESSION['update'] = 'Failed to update details';
        header("location:" . SITEURL . "update-user.php");
    }
}

?>
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

<div style="background-color:#74b659; padding: 80px 0;">
<div style="text-align:center;">
  <?php
    if(isset($_SESSION['update']))
    {
      echo''.$_SESSION['update'].'';
      unset($_SESSION['update']);
    }
  ?>
</div>
    <div class="container">
        <div style="background-color: #ffffff; padding: 40px; border-radius: 10px; max-width: 500px; margin: 0 auto;">
            <form action="" method="POST">
                <h2 style="text-align: center; margin-bottom: 30px;">Update User Details</h2>
                <div style="margin-bottom: 20px;">
                    <label for="username" style="display: block; margin-bottom: 5px;">Username:
                        <?php echo $_SESSION['user']; ?>
                    </label>
                </div>
                <div style="margin-bottom: 20px;">
                    <label for="cus_name" style="display: block; margin-bottom: 5px;">Full Name:</label>
                    <input type="text" id="cus_name" name="cus_name" value="<?php echo $cus_name; ?>" required
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>
                <div style="margin-bottom: 20px;">
                    <label for="cus_email" style="display: block; margin-bottom: 5px;">Email:</label>
                    <input type="email" id="cus_email" name="cus_email" value="<?php echo $cus_email; ?>" required
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>
                <div style="margin-bottom: 20px;">
                    <label for="cus_mobile" style="display: block; margin-bottom: 5px;">Phone:</label>
                    <input type="tel" id="cus_mobile" name="cus_mobile" value="<?php echo $cus_mobile; ?>" required
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>
                <div style="margin-bottom: 20px;">
                    <label for="cus_address" style="display: block; margin-bottom: 5px;">Address:</label>
                    <textarea id="cus_address" name="cus_address" required
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"><?php echo $cus_address; ?></textarea>
                </div>
                <div style="text-align: center;">
                    <button type="submit" name="submit"
                        style="background-color: #007bff; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Update
                        Details</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("partials-frontend/footer.php"); ?>