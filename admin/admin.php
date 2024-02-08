<?php include("partials/menu.php"); ?>

<h1 style="margin-left: 1%;">Manage Admin</h1>
<div style="text-align:center;">
  <?php
    if(isset($_SESSION['add']))
    {
      echo''.$_SESSION['add'].'';
      unset($_SESSION['add']);
    }
  ?>
</div>

<table class="table table-success table-striped"style="margin: 1%;width: 98%;">
<a href="add-admin.php" target="_self">
<button type="button" class="btn btn-primary"style="margin-left: 1%;" >Add Admin</button>
  <thead >
    <tr>
      <th scope="col">S.N.</th>
      <th scope="col">Username</th>
      <th scope="col">Password</th>
      <th scope="col">Role</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
            $sql = "SELECT * FROM logintable";
            $res = mysqli_query($conn,$sql);
            $id=1;

            if($res==TRUE)
            {
              $count = mysqli_num_rows($res);
              if($count> 0)
              {
                while($row = mysqli_fetch_array($res))
                {
                  $username =$row["username"];
                  $password =$row["password"];
                  $role =$row["roles"];
                  ?>
                <tr> 
                  <td><?php echo $id++;?>.</td>
                  <td><?php echo $username;?></td>
                  <td><?php echo $password;?></td>
                  <td><?php echo $role;?></td>
                  <td><button type="button" class="btn btn-success" >Update Admin</button>
                      <button type="button" class="btn btn-danger" >Delete Admin</button>
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