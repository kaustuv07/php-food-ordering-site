<?php include("partials-frontend/menu.php");
if (isset($_POST["submit"])) {
    $username = $_SESSION["user"];
    $password = md5($_POST["new_password"]);

    $sql = "UPDATE logintable SET
            password='$password'
            WHERE username = '$username'
            ";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['change'] = 'Password changed successfully';
        header("location:" . SITEURL . "user-panel.php");
    } else {
        $_SESSION['change'] = 'Failed to change password';
        header("location:" . SITEURL . "password-user.php");
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

<div style="background-color: #74b659; padding: 80px 0;">
    <div><h1>
        <?php
        if (isset($_SESSION['change'])) {
            echo $_SESSION['change'];
            unset($_SESSION['change']);
        } 
        ?></h1>
    </div>
    <div class="container">
        <div style="background-color: #ffffff; padding: 40px; border-radius: 10px; max-width: 500px; margin: 0 auto;">
            <h2 style="text-align: center; margin-bottom: 30px;">Change Password</h2>
            <form action="" method="post">
                <div style="margin-bottom: 20px;">
                    <label for="current_password" style="display: block; margin-bottom: 5px;">Current Password:</label>
                    <input type="password" id="current_password" name="current_password" required
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>
                <div style="margin-bottom: 20px;">
                    <label for="new_password" style="display: block; margin-bottom: 5px;">New Password:</label>
                    <input type="password" id="new_password" name="new_password" required
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>
                <div style="margin-bottom: 20px;">
                    <label for="confirm_password" style="display: block; margin-bottom: 5px;">Confirm New
                        Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                </div>
                <div style="text-align: center;">
                    <button type="submit"name="submit"
                        style="background-color: #007bff; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Change
                        Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include("partials-frontend/footer.php"); ?>