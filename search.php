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
            <?php include("partials-frontend/nav-bar.php"); ?>
            <!-- LOGIN BUTTON -->
            <ul>
            <li><b>
                <?php if(isset($_SESSION["user"]))
                {
                ?>
                    <a href="#" style="font-size: 25px;color: rgb(0, 217, 0);"><?php echo $_SESSION['user']; ?></a>
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
        <form class="search-bar-1" action="<?php echo SITEURL; ?>search.php" method="POST">
          <label id="search-bar-lable" for="search">Search...</label>
          <input
            id="search"
            type="search"
            placeholder="Search..."
            autofocus
            name ="search"
            required
          />
          <!-- SEARCH BUTTON -->
          <button id="search-button" type="submit">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </form>
      </div>
    </section>
    <?php $search = $_POST['search']; ?>
    <!-- Most Popular section -->
    <section class="menu" id="menu">
      <h1>&mdash;Search results for "<a style="color:yellow;"><?php echo $search?></a>"&mdash;</h1>

      <?php
          $sql = "SELECT * FROM  food INNER JOIN category ON
                  food.ca_id = category.ca_id
                  WHERE foodname LIKE '%$search%' OR description LIKE '%$search%'OR category LIKE '$search%'";
          $res = mysqli_query($conn,$sql);
          $count = mysqli_num_rows($res);

          if($count > 0)
          {
            while($row=mysqli_fetch_assoc($res))
            {
              $food_id = $row["food_id"];
              $foodname = $row["foodname"];
              $image_name = $row["image_name"];
              $cost = $row["cost"];
              $description = $row["description"];
              ?>
              <a href="#" style="text-decoration: none;">
                <div class="row" style ="display: inline-block;max-width:400px;">
                  <div class="menu-clm">
                    <img src="<?php echo SITEURL;?>css/images/food/<?php echo $image_name; ?>"alt="Pizza"/>
                    <h3 style="color: black;"><?php echo $foodname?></h3>
                    <h3 style="color: green;">Rs. <?php echo $cost?></h3>
                    </a>
                    <div class="layer"></div>
                  </div>
                </div>
              <?php
            }
          } 
          else
          {
            echo"<div class ='error'>Food not Found</div>";
          }
      ?>

    </section>
<?php include("partials-frontend/footer.php"); ?>