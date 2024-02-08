<?php include("partials/menu.php"); ?>

<h1 style="margin-left: 1%;">Manage Category</h1>

<table class="table table-success table-striped">
<button type="button" class="btn btn-primary"style="margin-left: 1%;" >Add Category</button>
  <thead >
    <tr>
      <th scope="col">Category_ID</th>
      <th scope="col">Category Types</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
            // Sample data, you'd typically fetch this from a database
            $users = [
                ['username' => 'user1', 'password' => 'password123','role' => 'Category',],
                ['username' => 'user2', 'password' => 'password456','role' => 'Category',]
            ];

            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>{$user['username']}</td>";
                echo "<td>" . str_repeat('*', strlen($user['password'])) . "</td>"; // Hide the password
                echo "<td>{$user['role']}</td>";
                ?>
                <td><button type="button" class="btn btn-success" >Update Category</button>
                <button type="button" class="btn btn-danger" >Delete Category</button>
                </td>
                <?php
                echo "</tr>";
            }
        ?>
  </tbody>
</table>



<?php include("partials/footer.php"); ?>