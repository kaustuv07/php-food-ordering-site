<?php
    if(!isset($_SESSION['user']))
    {
        $_SeSSION['no-login-message'] = "<div class='error text-center'>Please login to access services.</div>";
        header('location:'.SITEURL.'login.php');
    }