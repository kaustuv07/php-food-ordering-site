<?php include("partials/menu.php"); ?>
<h1 style="margin-left: 5%;">Add Category</h1>
<div style="text-align:center;">
  <?php
    if(isset($_SESSION['category']))
    {
      echo''.$_SESSION['category'].'';
      unset($_SESSION['category']);
    }
  ?>
</div>
<form action = "" method="POST">
  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="c_id" class="form-label">Category_Id</label>
    <input type="text" class="form-control" id="c_id" name="c_id" placeholder="Enter category id" required>
  </div>
  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="category" class="form-label">Category Type</label>
    <input type="text" class="form-control" id="category" name="category"placeholder="Enter category type" required>
  </div>
  <button type="submit" class="btn btn-primary"style="margin-left: 5%;margin-bottom:1%;"name="submit">Add Category</button>
</form>

<?php include("partials/footer.php"); ?>

<?php 
    if(isset($_POST["submit"]))
    {
        $ca_id=$_POST["ca_id"];
        $category=$_POST["category"];

        $sql = "INSERT INTO category SET
                ca_id='$ca_id',
                category='$category'
                ";
        
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
           $_SESSION['category'] = 'Category added successfully';
           header("location:".SITEURL."admin/category.php");
        }
        else
        {
            $_SESSION['category'] = 'Failed to Add Category';
           header("location:".SITEURL."admin/add-category.php");
        }
    }
?>

