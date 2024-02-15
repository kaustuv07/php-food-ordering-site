<?php include("partials/menu.php"); ?>
<div class="main-content">
<h1 class ="text-center">Dashboard</h1>
<br><br>
<div class ="text-center"style="color:white;text-align:center;display: inline-block;">
            <?php
                if(isset($_SESSION["login"]))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
        </div>
             <br><br>
    <div class = "wrapper"style="display: flex;">

        <div class = "col-2 text-center "style ="border: 1px solid white; padding: 5px;margin:1%;">
            <?php
                 $sql = "SELECT * FROM category";
                 $res = mysqli_query($conn, $sql);
                 $count = mysqli_num_rows($res);
            ?>
            <br><h1><?php echo $count;?></h1>
            Categories
        </div>

        <div class = "col-2 text-center"style ="border: 1px solid white; padding: 5px;margin:1%;">
            <?php
                 $sql2 = "SELECT * FROM food";
                 $res2 = mysqli_query($conn, $sql2);
                 $count2 = mysqli_num_rows($res2);
            ?>
            <br><h1><?php echo $count2?></h1>
            Foods
        </div>

        <div class = "col-2 text-center"style ="border: 1px solid white; padding: 5px;margin:1%;color:orange;">
            <?php
                 $sql3 = "SELECT * FROM ordertable WHERE orderstatus!='Delivered'";
                 $res3 = mysqli_query($conn, $sql3);
                 $count3 = mysqli_num_rows($res3);
            ?>
            <br><h1><?php echo $count3?></h1>
            Pending Orders
        </div>

        <div class = "col-2 text-center"style ="border: 1px solid white; padding: 5px;margin:1%;">
            <?php
                 $sql3 = "SELECT * FROM ordertable WHERE orderstatus='Delivered'";
                 $res3 = mysqli_query($conn, $sql3);
                 $count3 = mysqli_num_rows($res3);
            ?>
            <br><h1><?php echo $count3?></h1>
            Completed Orders
        </div>

        <div class = "col-2 text-center"style ="border: 1px solid white; padding: 5px;margin:1%;color:lightgreen;">
            <?php
                 $sql4 = "SELECT SUM(amount) AS Total From ordertable WHERE orderstatus='Delivered'";
                 $res4 = mysqli_query($conn, $sql4);
                 $row4 = mysqli_fetch_assoc($res4);
                 $total_revenue = $row4["Total"];
            ?>
            <br><h1>Rs. <?php echo $total_revenue ?></h1>
            Revenue Generated
            <br><br>
        </div>



        <div class ="clearfix"></div>
    </div>
</div>

<?php include("partials/footer.php"); ?>