<?php include("partials/menu.php"); ?>

<?php
    $ca_id =$_GET['ca_id'];
    $sql = "SELECT * FROM category WHERE ca_id ='$ca_id'";
    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $count = mysqli_num_rows($res);
        if($count==1)
        {
            $row = mysqli_fetch_assoc($res);
            $category = $row["category"];
        }
        else
        {
            header("location:".SITEURL."admin/category.php");
        }
    }

?>
<h1 style="margin-left: 5%;">Update Category</h1>
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
    <label for="ca_id" class="form-label">Category ID :  <?php echo $ca_id;?></label>
    <input type="hidden" name="ca_id" value="<?php echo $ca_id;?>" required>
  </div>
  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="category" class="form-label">Update Category Name:</label>
    <input type="text" class="form-control" name="category" value="<?php echo $category; ?>"required>
  </div>
  <button type="submit" class="btn btn-primary"style="margin-left: 5%;margin-bottom:1%;"name="submit">Update Category</button>
</form>

<?php include("partials/footer.php"); ?>

<?php 
    if(isset($_POST["submit"]))
    {
        $ca_id=$_POST["ca_id"];
        $category = $_POST["category"];

        $sql = "UPDATE category SET
                category = '$category'
                WHERE ca_id = '$ca_id'
                ";
        
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
           $_SESSION['update'] = 'Category updated successfully';
           header("location:".SITEURL."admin/category.php");
        }
        else
        {
            $_SESSION['update'] = 'Failed to update Category';
           header("location:".SITEURL."admin/update-category.php");
        }
    }
?>

