<?php include("partials/menu.php"); ?>

<h1 class ="text-center">Dashboard</h1>
<br>
<div style="color:white;text-align:center;">
<?php
                if(isset($_SESSION["login"]))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
</div>



<?php include("partials/footer.php"); ?>