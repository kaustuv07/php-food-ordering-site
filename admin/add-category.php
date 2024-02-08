<?php include("partials/menu.php"); ?>
<h1 style="margin-left: 5%;">Add Category</h1>
<div style="text-align:center;">
  <?php
    if(isset($_SESSION['add']))
    {
      echo''.$_SESSION['add'].'';
      unset($_SESSION['add']);
    }
  ?>
</div>
<form action = "" method="POST">
  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="your username" required>
  </div>
  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password"placeholder="your password" required>
  </div>
  <button type="submit" class="btn btn-primary"style="margin-left: 5%;margin-bottom:1%;"name="submit">Add Admin</button>
</form>

<?php include("partials/footer.php"); ?>

<?php 
    if(isset($_POST["submit"]))
    {
        $username=$_POST["username"];
        $password=md5($_POST["password"]);

        $sql = "INSERT INTO logintable SET
                username='$username',
                password='$password',
                roles='admin'
                ";
        
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
           $_SESSION['add'] = 'Admin added successfully';
           header("location:".SITEURL."admin/admin.php");
        }
        else
        {
            $_SESSION['add'] = 'Failed to Add Admin';
           header("location:".SITEURL."admin/add-admin.php");
        }
    }
?>

