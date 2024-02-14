<?php include("partials/menu.php"); ?>

<h1 style="margin-left: 1%;">Manage Orders</h1>

<table class="table table-success table-striped">
<button type="button" class="btn btn-primary" style="margin-left:1%;">Add Order</button>
  <thead >
    <tr>
      <th scope="col">Order_ID</th>
      <th scope="col">DATE AND TIME</th>
      <th scope="col">Food_id</th>
      <th scope="col">Amount</th>
      <th scope="col">Order_status</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
            // Sample data, you'd typically fetch this from a database
            $users = [
                ['username' => 'user1', 'password' => 'password123','role' => 'Order',],
                ['username' => 'user2', 'password' => 'password456','role' => 'Order',]
            ];

            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>{$user['username']}</td>";
                echo "<td>" . str_repeat('*', strlen($user['password'])) . "</td>"; // Hide the password
                echo "<td>{$user['role']}</td>";
                ?>
                <td><button type="button" class="btn btn-success" >Update Order</button>
                <button type="button" class="btn btn-danger" >Delete Order</button>
                </td>
                <?php
                echo "</tr>";
            }
        ?>
  </tbody>
</table>



<?php include("partials/footer.php"); ?>