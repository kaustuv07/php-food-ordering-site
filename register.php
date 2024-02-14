<?php include("config/constants.php"); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Signup</title>
    <link rel="stylesheet" href="css/register.css" />
  </head>
  <body>
    <section>
      <div class="form-box">
        <form action=""method="post">
          <h2>Register</h2>

          <br>
            <div style="color:white;">
            <?php
                if(isset($_SESSION["register"]))
                {
                    echo $_SESSION['register'];
                    unset($_SESSION['register']);
                }
            ?>

          <div class="inputbox">
            <ion-icon name="person-circle-outline"></ion-icon>
            <input type="text" id="firstName" name="firstName" required />
            <label for="firstName">Legal Name</label>
          </div>

          <div class="inputbox">
            <ion-icon name="person-circle-outline"></ion-icon>
            <input type="text" id="username" name="username"required />
            <label for="username">Create Username</label>
          </div>

          <div class="inputbox">
            <ion-icon name="person-circle-outline"></ion-icon>
            <input type="email" id="email" name="email"required />
            <label for="email">Email</label>
          </div>
          <div class="inputbox">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="number"id="contact" name="contact" required />
            <label for="contact">Contact Number</label>
          </div>

          <div class="inputbox">
            <ion-icon name="person-circle-outline"></ion-icon>
            <input type="text" id="address" name="address"required />
            <label for="address">Your Address</label>
          </div>

          <div class="inputbox">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="password" id="password" name="password"required />
            <label for="password">Password</label>
          </div>
          <div class="inputbox">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="password"id="cpassword" name="cpassword" required />
            <label for="cpassword">Re-enter Password</label>
          </div>
          <button type ="submit" name = "submit">Register</button>

          <div class="login">
            <p>Already have an account?<a href="login.php"> Sign In</a></p>
          </div>
        </form>
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
  </body>
</html>

<?php

    if(isset($_POST["submit"]))
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $cus_name = $_POST["firstName"];
        $cus_mobile = $_POST["contact"];
        $cus_email = $_POST["email"];
        $cus_address = $_POST["address"];

        $sql = "INSERT INTO logintable SET
                username='$username',
                password='$password',
                roles='customer'";

        $sql2 = "INSERT INTO customerdetails (cus_name, cus_mobile, cus_email, cus_address, username)
                 VALUES ('$cus_name', '$cus_mobile', '$cus_email', '$cus_address', '$username')";
;

        $res = mysqli_query($conn, $sql);
        if (!$res) {
            die("Query failed: " . mysqli_error($conn));
        }
        $res2 = mysqli_query($conn, $sql2);
        if (!$res2) {
          die("Query failed: " . mysqli_error($conn));
      }

        if($res && $res2)
        {
            $_SESSION['register'] = "<div class='success' style='text-align:center;'>Register Successfull.</div>";
            $_SESSION['user'] = $username;

            header('location:'.SITEURL.'login.php');
        }
        else
        {
            $_SESSION['register'] = "<div class = 'error text-center'>Failed to create User.</div>";
            header("location:".SITEURL."register.php");
        }
    } 
?>
