<?php 
    include("../config/constants.php");

    if(isset($_GET["username"]))
    {
        $username = $_GET['username'];

        $sql = "DELETE FROM logintable WHERE username='$username'";
        try{

        $res = mysqli_query($conn,$sql);

        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>User Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/admin.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='success'>Failed to Delete User</div>";
            header('location:'.SITEURL.'admin/admin.php');

        }
    }catch(mysqli_sql_exception $e){
        $_SESSION['delete'] = "<div class='success'>Failed to Delete User</div>";
            header('location:'.SITEURL.'admin/admin.php');
    }

    }
    else
    {
        header('location:'.SITEURL.'admin/admin.php');
    }