<?php 
    include("../config/constants.php");

    echo"delete page";

    if(isset($_GET["ca_id"]))
    {
        $ca_id = $_GET['ca_id'];

        $sql = "DELETE FROM category WHERE ca_id=$ca_id";

        $res = mysqli_query($conn,$sql);

        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/category.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='success'>Failed to Delete Category</div>";
            header('location:'.SITEURL.'admin/category.php');

        }

    }
    else
    {
        header('location:'.SITEURL.'admin/category.php');
    }