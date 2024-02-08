<?php 
    include("../config/constants.php");

    if(isset($_GET["food_id"]))
    {
        $food_id = $_GET['food_id'];

        $sql = "DELETE FROM food WHERE food_id='$food_id'";

        try{
        $res = mysqli_query($conn,$sql);

        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/food.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='success'>Failed to Delete Food</div>";
            header('location:'.SITEURL.'admin/food.php');

        }
    }catch(mysqli_sql_exception $e){
        $_SESSION['delete'] = "<div class='success'>Failed to Delete Food</div>";
            header('location:'.SITEURL.'admin/food.php');
    }

    }
    else
    {
        header('location:'.SITEURL.'admin/food.php');
    }