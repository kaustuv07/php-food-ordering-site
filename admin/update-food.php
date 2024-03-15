<?php include("partials/menu.php"); ?>

<?php
    $food_id =$_GET['food_id'];
    $sql = "SELECT * FROM food WHERE food_id ='$food_id'";
    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $count = mysqli_num_rows($res);
        if($count==1)
        {
            $row = mysqli_fetch_assoc($res);
            $foodname = $row["foodname"];
            $ca_id = $row["ca_id"];
            $cost = $row['cost'];
            $description = $row["description"];
            $image_name = $row["image_name"];
            $featured = $row["featured"];
            $active = $row["active"];
        }
        else
        {
            header("location:".SITEURL."admin/food.php");
        }
    }
    if(isset($_POST["submit"]))
    {
        $food_id=$_POST["food_id"];
        $foodname = $_POST["foodname"];
        $category= $_POST["category"];
        $cost = $_POST["cost"];
        $description = $_POST["description"];
        $featured = $_POST["featured"];
        $active = $_POST["active"];

        $sql = "SELECT ca_id FROM category WHERE category = '$category'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $ca_id = $row['ca_id'];
        
        if (isset($_FILES['image'])) {
            $image_name = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            $image_dst = "../css/images/food/" . $image_name;
            
            if (move_uploaded_file($image_tmp, $image_dst)) {
                // Image uploaded successfully
                $sql = "UPDATE food SET
                foodname = '$foodname',
                ca_id = '$ca_id',
                cost = '$cost',
                description = '$description',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
                WHERE food_id = '$food_id'
                ";
                if (mysqli_query($conn, $sql)) {
                    $_SESSION['update'] = 'Food updated successfully';
                    $current_image = $_POST["current_image"];
                    $path = "../css/images/food/".$current_image;
                    $remove = unlink($path);
                    header("location:".SITEURL."admin/food.php");
                } else {
                    $_SESSION['update'] = 'Failed to update Food';
                    header("location:".SITEURL."admin/update-food.php");
                    exit();
                }
            } else {
                // Failed to upload image
                $_SESSION['update'] = "<div class='error' style='text-align:center;'>Failed to upload image.</div>";
                header('location:' . SITEURL . 'admin/update-food.php');
                exit();
            }
        } else {
         $sql = "UPDATE food SET
                foodname = '$foodname',
                ca_id = '$ca_id',
                cost = '$cost',
                description = '$description',
                featured = '$featured',
                active = '$active'
                WHERE food_id = '$food_id'
                ";
                if (mysqli_query($conn, $sql)) {
                    $_SESSION['update'] = 'Food updated successfully';
                    header("location:".SITEURL."admin/food.php");
                } else {
                    $_SESSION['update'] = 'Failed to update Food';
                    header("location:".SITEURL."admin/update-food.php");
                    exit();
                }
            // Image not uploaded
            $_SESSION['update'] = "<div class='error' style='text-align:center;'>Image not uploaded.</div>";
            header('location:' . SITEURL . 'admin/update-food.php');
            exit();
        }
    }
?>
<h1 style="margin-left: 5%;">Update Food</h1>
<div style="text-align:center;">
  <?php
    if(isset($_SESSION['update']))
    {
      echo''.$_SESSION['update'].'';
      unset($_SESSION['update']);
    }
  ?>
</div>
<form action = "" method="POST"enctype="multipart/form-data">

<input type="hidden" name="food_id" value="<?php echo $food_id;?>" required>

<div class="mb-3" style="max-width: 300px; margin-left: 5%;">
        <label for="image" class="form-label">Select Food Image:</label>
        <input type="file" class="form-control" id="image" name="image">
        <p>Current Image: <?php echo $image_name; ?></p>
    </div>
    <input type="hidden" name="current_image" value="<?php echo $image_name;?>">

  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="foodname" class="form-label">Food Name:</label>
    <input type="text" class="form-control" id="foodname" name="foodname" value="<?php echo $foodname;?>" required>
  </div>
  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
   
  <?php
// Fetch options from the database
$options = array();
$result = $conn->query("SELECT category FROM category");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options[] = $row;
    }
}
?>
<label for="category">Select a Category: </label>
<br>
<select id="category" name="category">
    <?php foreach ($options as $option): ?>
        <option><?php echo $option['category']; ?></option>
    <?php endforeach; ?>
</select>


  </div>
  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="cost" class="form-label">Cost:</label>
    <input type="number" class="form-control" id="cost" name="cost"value="<?php echo $cost;?>" required>
  </div>
  <div class="mb-3" style="max-width: 300px; margin-left: 5%;">
        <label for="description" class="form-label">Description:</label>
        <textarea name="description" cols="30" rows="2" required><?php echo $description;?></textarea>
    </div>

  <div class="mb-3" style="max-width: 300px; margin-left: 5%;">
        <label for="featured" class="form-label">Featured:</label>
        <input type="radio" id="featured" name="featured" value="Yes" <?php if($featured == 'Yes') echo 'checked'; ?> required>Yes
        <input type="radio" id="featured" name="featured" value="No" <?php if($featured == 'No') echo 'checked'; ?> required>No
    </div>

  <div class="mb-3" style="max-width: 300px; margin-left: 5%;">
        <label for="active" class="form-label">Active:</label>
        <input type="radio" id="active" name="active" value="Yes" <?php if($active == 'Yes') echo 'checked'; ?> required>Yes
        <input type="radio" id="active" name="active" value="No" <?php if($active == 'No') echo 'checked'; ?> required>No
    </div>

  <button type="submit" class="btn btn-primary"style="margin-left: 5%;margin-bottom:1%;"name="submit">Update Food</button>
</form>
<?php include("partials/footer.php"); ?>

