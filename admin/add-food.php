<?php include("partials/menu.php"); ?>
<h1 style="margin-left: 5%;">Add Food</h1>
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
    <label for="foodname" class="form-label">Food Name</label>
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
    <label for="cost" class="form-label">Cost</label>
    <input type="number" class="form-control" id="cost" name="cost"placeholder="Enter Food Cost" required>
  </div>
  <div class="mb-3"style="max-width: 300px;margin-left: 5%;">
    <label for="category" class="form-label">Description</label>
    <input type="text" class="form-control" id="description" name="description"placeholder="Enter Food Description" required>
  </div>

  <button type="submit" class="btn btn-primary"style="margin-left: 5%;margin-bottom:1%;"name="submit">Add Food</button>
</form>

<?php include("partials/footer.php"); ?>

<?php 
    if(isset($_POST["submit"]))
    {
        $foodname=$_POST["foodname"];
        $category=$_POST["category"];
        $cost=$_POST["cost"];
        $description = $_POST["description"];

        $sql = "SELECT ca_id FROM category WHERE category = '$category'";
        
        $res = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($res))
                {
                    $ca_id =$row["ca_id"];
                }





        $sql = "INSERT INTO food SET
                foodname='$foodname',
                ca_id='$ca_id',
                cost = '$cost',
                description = '$description'
                ";
        
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
           $_SESSION['category'] = 'Food added successfully';
           header("location:".SITEURL."admin/food.php");
        }
        else
        {
            $_SESSION['category'] = 'Failed to Add Food';
           header("location:".SITEURL."admin/add-food.php");
        }
    }
?>

