<?php include("partials/menu.php"); ?>

<h1 style="margin-left: 1%;">Manage Foods</h1>
<div style="text-align:center;">
  <?php
    if(isset($_SESSION['category']))
    {
      echo''.$_SESSION['category'].'';
      unset($_SESSION['category']);
    }
    if(isset($_SESSION['delete']))
    {
      echo''.$_SESSION['delete'].'';
      unset($_SESSION['delete']);
    }
  ?>
</div>

<table class="table table-success table-striped"style="margin: 1%;width: 98%;">
<a href="add-food.php" target="_self">
<button type="button" class="btn btn-primary"style="margin-left: 1%;" >Add Food</button>
  <thead >
    <tr>
      <th scope="col">S.N.</th>
      <th scope="col">Image</th>
      <th scope="col">Food Name</th>
      <th scope="col">Category</th>
      <th scope="col">Cost</th>
      <th scope="col">Description</th>
      <th scope="col">Featured</th>
      <th scope="col">Active</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
            $sql = "SELECT * FROM category 
                    INNER JOIN food ON
                    category.ca_id = food.ca_id";
            $res = mysqli_query($conn,$sql);
            $id=1;

            if($res==TRUE)
            {
              $count = mysqli_num_rows($res);
              if($count> 0)
              {
                while($row = mysqli_fetch_array($res))
                {
                  $food_id = $row["food_id"];
                  $image_name=$row["image_name"];
                  $foodname = $row["foodname"];
                  $category =$row["category"];
                  $cost = $row["cost"];
                  $description = $row["description"];
                  $featured= $row["featured"];
                  $active= $row["active"];
                  ?>
                <tr> 
                  <td><?php echo $id++;?>.</td>
                  <td><img src="<?php echo SITEURL;?>css/images/food/<?php echo $image_name;?>" width="50px"></td>
                  <td style="max-width: 250px;"><?php echo $foodname;?></td>
                  <td><?php echo $category;?></td>
                  <td>Rs. <?php echo $cost;?></td>
                  <td style="max-width: 250px;"><?php echo $description;?></td>
                  <td><?php echo $featured;?></td>
                  <td><?php echo $active;?></td>
                  <td style="max-width: 400px;><button type="button" class="btn btn-success" >Update Food</button>
                  <a href="<?php echo SITEURL; ?>admin/delete-food.php?food_id=<?php echo $food_id; ?>&image_name=<?php echo $image_name; ?>" target="_self">
                      <button type="button" class="btn btn-danger" >Delete Food</button>
                  </td>
                </tr>
                <?php
            }
          }else{

          }
          }
        ?>
  </tbody>
</table>



<?php include("partials/footer.php"); ?>