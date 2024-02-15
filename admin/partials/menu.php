<?php include("../config/constants.php");
      include("login-check.php"); 
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body style="background-color:rgb(10, 38, 71);color:white;">
  <nav class="navbar navbar-expand-lg">
  <div class="container-fluid" style="background-color:lightblue;">
    <a class="navbar-brand" href="index.php"style="margin-right: 50px;">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="admin.php"style="margin-right: 50px;">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="category.php"style="margin-right: 50px;">Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="food.php"style="margin-right: 50px;">Foods</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="order.php"style="margin-right: 50px;">Orders</a>
        </li>
        
          <a href="logout.php" style="float: right;color:red;margin-left: 125%;font-size:28px;"><b>LogOut</b></a>
        
      </ul>
    </div>
  </div>
</nav>