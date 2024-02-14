<?php include("partials/menu.php"); ?>
<h1 style="margin-left: 5%;">Add Food</h1>
<div style="text-align:center;">
  <?php
    if(isset($_SESSION['category']))
    {
      echo''.$_SESSION['category'].'';
      unset($_SESSION['category']);
    }
    if(isset($_SESSION['upload']))
    {
      echo''.$_SESSION['upload'].'';
      unset($_SESSION['upload']);
    }
  ?>
</div>
<form action = "" method="POST"enctype="multipart/form-data">

<div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="image" class="form-label">Select Food Image:</label>
    <input type="file" class="form-control" id="image" name="image" required>
  </div>

  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="foodname" class="form-label">Food Name:</label>
    <input type="text" class="form-control" id="foodname" name="foodname"placeholder="Enter Food Name" required>
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
    <input type="number" class="form-control" id="cost" name="cost"placeholder="Enter Food Cost" required>
  </div>
  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="description" class="form-label">Description:</label>
    <textarea name="description" cols="30" rows="2" placeholder="Description of food"required></textarea>
  </div>

  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="featured" class="form-label">Featured:</label>
    <input type="radio" id="featured" name="featured" value="Yes"required>Yes
    <input type="radio" id="featured" name="featured" value="No"required>No
  </div>

  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="active" class="form-label">Active :  </label>
    <input type="radio" id="active" name="active" value="Yes"required>Yes
    <input type="radio" id="active" name="active" value="No"required>No
  </div>

  <button type="submit" class="btn btn-primary"style="margin-left: 5%;margin-bottom:1%;"name="submit">Add Food</button>
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $foodname = $_POST["foodname"];
      $category = $_POST["category"];
      $cost = $_POST["cost"];
      $description = $_POST["description"];
      $featured = $_POST["featured"];
      $active = $_POST["active"];
      
      // Retrieve category ID from the database
      $sql = "SELECT ca_id FROM category WHERE category = '$category'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $ca_id = $row['ca_id'];
  
      // File upload handling
      if (isset($_FILES['image'])) {
          $image_name = $_FILES['image']['name'];
          $image_tmp = $_FILES['image']['tmp_name'];
          $image_dst = "../css/images/food/" . $image_name;
          
          if (move_uploaded_file($image_tmp, $image_dst)) {
              // Image uploaded successfully
              $sql = "INSERT INTO food (foodname, ca_id, cost, description, image_name, featured, active) 
                      VALUES ('$foodname', '$ca_id', '$cost', '$description', '$image_name', '$featured', '$active')";
              if (mysqli_query($conn, $sql)) {
                  $_SESSION['category'] = 'Food added successfully';
                  header("location:" . SITEURL . "admin/food.php");
                  exit();
              } else {
                  $_SESSION['category'] = 'Failed to add food';
                  header("location:" . SITEURL . "admin/add-food.php");
                  exit();
              }
          } else {
              // Failed to upload image
              $_SESSION['upload'] = "<div class='error' style='text-align:center;'>Failed to upload image.</div>";
              header('location:' . SITEURL . 'admin/add-food.php');
              exit();
          }
      } else {
          // Image not uploaded
          $_SESSION['upload'] = "<div class='error' style='text-align:center;'>Image not uploaded.</div>";
          header('location:' . SITEURL . 'admin/add-food.php');
          exit();
      }
  }
  include("partials/footer.php");
?>

