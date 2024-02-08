<?php include("partials/menu.php"); ?>

<h1 style="margin-left: 1%;">Manage Food</h1>

<table class="table table-success table-striped">
<button type="button" class="btn btn-primary"style="margin-left: 1%;" >Add Food</button>
  <thead >
    <tr>
      <th scope="col">Food_ID</th>
      <th scope="col">Name</th>
      <th scope="col">Category</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
            // Sample data, you'd typically fetch this from a database
            $users = [
                ['username' => 'user1', 'password' => 'password123','role' => 'Food',],
                ['username' => 'user2', 'password' => 'password456','role' => 'Food',]
            ];

            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>{$user['username']}</td>";
                echo "<td>" . str_repeat('*', strlen($user['password'])) . "</td>"; // Hide the password
                echo "<td>{$user['role']}</td>";
                ?>
                <td><button type="button" class="btn btn-success" >Update Food</button>
                <button type="button" class="btn btn-danger" >Delete Food</button>
                </td>
                <?php
                echo "</tr>";
            }
        ?>
  </tbody>
</table>



<?php include("partials/footer.php"); ?>