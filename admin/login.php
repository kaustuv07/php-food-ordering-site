<?php include("../config/constants.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="./css/login.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Log-In-SnackPack</title>
  </head>
  <body>
    <section>
      <div class="form-box">
        <div class="form-value">
          <form action="" method="post">
            <h2>Login</h2>
            <br>
            <div style="color:white;">
            <?php
                if(isset($_SESSION["login"]))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            </div>
            <div class="inputbox">
              <ion-icon name="person-circle-outline"></ion-icon>
              <input type="username" id = "username" name="username"required />
              <label for="username">Username</label>
            </div>
            <div class="inputbox">
              <ion-icon name="lock-closed-outline"></ion-icon>
              <input type="password" id = "password" name = "password"required />
              <label for="password">Password</label>
            </div>
            <button type = "submit"name="submit">Log in</button>
          </form >
        </div>
      </div>
    </section>
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>
    <script src = "javascript/loginscript.js"></script>
  </body>
</html>

<?php

    if(isset($_POST["submit"]))
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM logintable WHERE username='$username'AND password='$password'";
        $res = mysqli_query($conn, $sql);
        if (!$res) {
            die("Query failed: " . mysqli_error($conn));
        }
        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            $_SESSION['login'] = "<div class='success'>Login Successfull.</div>";
            $_SESSION['user'] = $username;

            header('location:'.SITEURL.'admin/index.php');
        }
        else
        {
            $_SESSION['login'] = "<div class = 'error text-center'>Username or Password did not match.</div>";
            header("location:".SITEURL."admin/login.php");
        }
    } 
?>
