<?php include("partials-frontend/menu.php"); ?>
<section class="top-page">
      <div id="header">
        <div class="container">
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
                    <a href="user-panel.php" style="font-size: 25px;color: rgb(0, 217, 0);"><?php echo $_SESSION['user']; ?></a>
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
      <!-- HEADER -->
      <div class="header-text">
        <h3>SnackPack</h3>
        <h1>Savor the Flavor: Your Table, Your Taste, Your Time.</h1>
      </div>
      <!-- SEACH BAR -->
      <div class="search-bar-frontpage">
        <form class="search-bar-1" action="<?php echo SITEURL;?>search.php" method ="POST">
          <label id="search-bar-lable" for="search">Search...</label>
          <input
            id="search"
            type="search"
            placeholder="Search for Food..."
            autofocus
            name ="search"
            required
          />
          <!-- SEARCH BUTTON -->
          <button id="search-button" type="submit" name="submit">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </form>
      </div>
    </section>
    <!-- Most Popular section -->
    <section class="menu" id="menu">
      <h1>&mdash; Most Popular &mdash;</h1>

      <?php
          $sql = "SELECT * FROM  food WHERE active ='Yes' AND featured ='Yes' LIMIT 3";
          $res = mysqli_query($conn,$sql);
          $count = mysqli_num_rows($res);

          if($count > 0)
          {
            while($row=mysqli_fetch_array($res))
            {
              $food_id = $row["food_id"];
              $foodname = $row["foodname"];
              $image_name = $row["image_name"];
              ?>
              <a href="#" style="text-decoration: none;">
                <div class="row" style ="display: inline-block;max-width:400px;">
                  <div class="menu-clm">
                    <img src="<?php echo SITEURL;?>css/images/food/<?php echo $image_name; ?>"alt="Pizza"/>
                    <h3 style="color: black;"><?php echo $foodname?></h3>
                    </a>
                    <div class="layer"></div>
                  </div>
                </div>
              <?php
            }
          } 
      ?>

    </section>

    <!-- ABOUT  -->
    <section class="about" id="about">
      <h3 class="sub-heading">&mdash; WHY CHOOSE US &mdash;</h3>
      <div class="row">
        <div class="image">
          <img src="./css/images/logo.png" alt="" />
        </div>
        <div class="content">
          <h2>About Us</h2>
          <p>
            Welcome to SnackPack, a culinary haven redefining the art of
            snacking. Born out of a passion for crafting innovative snacks,
            SnackPack transforms traditional snacking into a vibrant culinary
            adventure that celebrates the joy of sharing good food. With a
            commitment to using the finest, locally-sourced ingredients, each
            snack is a carefully curated blend of flavors designed to cater to
            diverse tastes. The cozy and welcoming ambiance at SnackPack
            encourages community and connection, making it the perfect place to
            create lasting memories. Join us on a culinary journey where every
            bite is a burst of freshness and goodness
          </p>
          <h1>
            "Welcome to SnackPack, where snacking becomes an artful celebration
            of life."
          </h1>
          <a href="" class="read-more"> Read More</a>
        </div>
      </div>
    </section>

    <!-- REVIEW -->
    <section class="review" id="review">
      <h2>&mdash; Customer Reviews &mdash;</h2>
      <div class="slide">
        <i class="fas fa-quote-right"></i>
        <div class="user">
          <img src="./css/images/santosh.jpg" />
          <div class="userinfo">
            <h3>Santosh Shah</h3>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
          </div>
          <p>
            I really recommend all the food lovers to try peperoni pizza from
            SnackPack. It's finger licking good.
          </p>
        </div>
      </div>
      <div class="slide">
        <i class="fas fa-quote-right"></i>
        <div class="user">
          <img src="./css/images/girl.jpg" />
          <div class="userinfo">
            <h3>Rabina Dhakal</h3>
            <div class="stars">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
          </div>
          <p>Tastes better and fast delivery. Best in town.</p>
        </div>
      </div>
    </section>

    <!-- CONTACT SECTION -->
    <section class="contact" id="contact">
      <h1 class="title">&mdash; Contact Us &mdash;</h1>
      <div class="contact-info-upper-container">
        <div class="contact-info-container">
          <img
            src="./css/images/email.png"
            alt="email icon"
            class="icon contact-icon mail-icon"
          />
          <p>
            <a href="mailto:snackpack@gmail.com">snackpack@gmail.com</a>
          </p>
        </div>
        <div class="contact-info-container">
          <img
            src="./css/images/phone.png"
            alt="phone icon"
            class="icon contact-icon phone-icon"
          />
          <p>+977-9828932151</p>
        </div>
        <div class="contact-info-container">
          <img
            src="./css/images/facebook.png"
            alt="facebook icon"
            class="icon contact-icon"
          />
          <p>
            <a href="https://www.facebook.com" target="_blank">Facebook</a>
          </p>
        </div>
        <div class="contact-info-container">
          <img
            src="./css/images/instagram.png"
            alt="instagram icon"
            class="icon contact-icon"
          />
          <p>
            <a href="https://www.instagram.com" target="_blank">Instagram</a>
          </p>
        </div>
        <div class="contact-info-container">
          <img
            src="./css/images/linkedin.png"
            alt="linkendin icon"
            class="icon contact-icon"
          />
          <p>
            <a href="https://www.linkedin.com" target="_blank">LinkedIn</a>
          </p>
        </div>
      </div>
    </section>
<?php include("partials-frontend/footer.php"); ?>