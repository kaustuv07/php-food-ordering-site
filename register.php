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
        <form method="post">
          <h2>Register</h2>
          <div class="inputbox">
            <ion-icon name="person-circle-outline"></ion-icon>
            <input type="First Name" required />
            <label for="">First Name</label>
          </div>
          <div class="inputbox">
            <ion-icon name="person-circle-outline"></ion-icon>
            <input type="Last Name" required />
            <label for="">Last Name</label>
          </div>
          <div class="inputbox">
            <ion-icon name="person-circle-outline"></ion-icon>
            <input type="Email" required />
            <label for="">Email</label>
          </div>
          <div class="inputbox">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="Contact Number" required />
            <label for="">Contact Number</label>
          </div>
          <div class="inputbox">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="password" required />
            <label for="">Password</label>
          </div>
          <div class="inputbox">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="Re-enter Password" required />
            <label for="">Re-enter Password</label>
          </div>
          <button>Register</button>

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
