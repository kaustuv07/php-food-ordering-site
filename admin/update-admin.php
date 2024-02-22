<?php include("partials/menu.php"); 
    $username =$_GET['username'];
    $sql = "SELECT * FROM logintable WHERE username ='$username'";
    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $count = mysqli_num_rows($res);
        if($count==1)
        {
            $row = mysqli_fetch_assoc($res);
            $username = $row["username"];
            $password = $row["password"];
            $roles = $row["roles"];
        }
        else
        {
            header("location:".SITEURL."admin/manage-admin.php");
        }
    }

    if(isset($_POST["submit"]))
    {
        $username=$_POST["username"];
        $password=md5($_POST["password"]);
        $roles = $_POST["roles"];

        $sql = "UPDATE logintable SET
                password='$password',
                roles='$roles'
                WHERE username = '$username'
                ";
        
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
           $_SESSION['update'] = 'User updated successfully';
           header("location:".SITEURL."admin/admin.php");
        }
        else
        {
            $_SESSION['update'] = 'Failed to update User';
           header("location:".SITEURL."admin/update-admin.php");
        }
    }

?>
<h1 style="margin-left: 5%;">Update User</h1>
<div style="text-align:center;">
  <?php
    if(isset($_SESSION['update']))
    {
      echo''.$_SESSION['update'].'';
      unset($_SESSION['update']);
    }
  ?>
</div>
<form action = "" method="POST">
  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="username" class="form-label">Username :  <?php echo $username;?></label>
    <input type="hidden" name="username" value="<?php echo $username;?>" required>
  </div>
  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="roles" class="form-label">Update Role :</label>
    <input type="radio" id="roles" name="roles" value="admin" <?php if($roles == 'admin') echo 'checked'; ?> required>Admin
    <input type="radio" id="roles" name="roles" value="customer" <?php if($roles == 'customer') echo 'checked'; ?> required>Customer
  </div>
  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="password" class="form-label">Update Password:</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password" required>
  </div>
  <button type="submit" class="btn btn-primary"style="margin-left: 5%;margin-bottom:1%;"name="submit">Update User</button>
</form>

<?php include("partials/footer.php"); ?>

