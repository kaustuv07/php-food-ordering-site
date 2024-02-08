<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="css/login.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
  </head>
  <body>
    <section>
      <div class="form-box">
        <div class="form-value">
          <form id="loginForm" action="welcome.html" method="post" onsubmit="return checkProfile()">
            <h2>Login</h2>
            <div class="inputbox">
              <ion-icon name="person-circle-outline"></ion-icon>
              <input type="username" id = "username" name="username"required />
              <label for="username">Username</label>
            </div>
            <div class="inputbox">
              <ion-icon name="lock-closed-outline"></ion-icon>
              <input type="password" id = "password" name="password"required />
              <label for="password">Password</label>
            </div>
            <div class="forget">
              <label for="checkbox"
                ><input type="checkbox" id="checkbox" />Remember Me |
                <a href="#"><b>Forget Password</b></a></label
              >
            </div>
            <button type = "submit">Log in</button>
            <div id="popup" style="display: none;color:white;">
              <p style="text-align: center;margin-left: 30px;">Invalid Username or Password</p>
            </div>
            <div class="register">
              <p>Don't have a account <a href="register.html">Register</a></p>
            </div>
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
