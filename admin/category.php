<?php include("partials/menu.php"); ?>

<h1 style="margin-left: 1%;">Manage Category</h1>
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
<a href="add-category.php" target="_self">
<button type="button" class="btn btn-primary"style="margin-left: 1%;" >Add Category</button>
  <thead >
    <tr>
      <th scope="col">S.N.</th>
      <th scope="col">Category Types</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
            $sql = "SELECT * FROM category";
            $res = mysqli_query($conn,$sql);
            $id=1;

            if($res==TRUE)
            {
              $count = mysqli_num_rows($res);
              if($count> 0)
              {
                while($row = mysqli_fetch_array($res))
                {
                  $ca_id =$row["ca_id"];
                  $category =$row["category"];
                  ?>
                <tr> 
                  <td><?php echo $id++;?>.</td>
                  <td><?php echo $category;?></td>
                  <td><button type="button" class="btn btn-success" >Update Category</button>
                  <a href="<?php echo SITEURL; ?>admin/delete-category.php?ca_id=<?php echo $ca_id; ?>" target="_self">
                      <button type="button" class="btn btn-danger" >Delete Category</button>
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