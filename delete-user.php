<?php 
    include("config/constants.php");

    if(isset($_GET["username"]))
    {
        $username = $_GET['username'];

        $sql = "DELETE logintable, customerdetails
                FROM logintable
                INNER JOIN customerdetails ON logintable.username = customerdetails.username
                WHERE logintable.username ='$username';
        ";
        try{

        $res = mysqli_query($conn,$sql);

        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>User Deleted Successfully</div>";
            header('location:'.SITEURL.'login.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='success'>Failed to Delete User</div>";
            header('location:'.SITEURL.'user-panel.php');

        }
    }catch(mysqli_sql_exception $e){
        $_SESSION['delete'] = "<div class='success'>Failed to Delete User</div>";
            header('location:'.SITEURL.'user-panel.php');
    }

    }
    else
    {
        header('location:'.SITEURL.'user-panel.php');
    }