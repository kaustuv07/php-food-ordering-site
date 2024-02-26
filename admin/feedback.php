<?php include("partials/menu.php"); ?>

<h1 style="margin-left: 1%;">Customer Feedbacks</h1>

<div style="text-align:center;">
  <?php
    if(isset($_SESSION['update']))
    {
      echo''.$_SESSION['update'].'';
      unset($_SESSION['update']);
    }
  ?>
</div>

<table class="table table-success table-striped"style="margin: 1%;width: 98%;" id ="table">
  <thead >
    <tr>
      <th scope="col"onclick="sortTable(1)">Feedback Date</th>
      <th scope="col"onclick="sortTable(2)">Food Item</th>
      <th scope="col"onclick="sortTable(3)">Username</th>
      <th scope="col"onclick="sortTable(4)">Rating</th>
      <th scope="col"onclick="sortTable(5)">Feedback</th>
    </tr>
  </thead>
  <tbody>
  <?php
            $sql = "SELECT * FROM feedback 
            INNER JOIN food ON
            food.food_id = feedback.food_id
            INNER JOIN customerdetails ON
            customerdetails.cus_id = feedback.cus_id
            ORDER BY date DESC;
            ";
            $res = mysqli_query($conn,$sql);

            if($res==TRUE)
            {
              $count = mysqli_num_rows($res);
              if($count> 0)
              {
                while($row = mysqli_fetch_array($res))
                {
                  $feedback_id =$row["feedback_id"];
                  $foodname =$row["foodname"];
                  $username = $row["username"];
                  $date = $row["date"];
                  $feedback = $row["feedback"];
                  $rating = $row["rating"];
                  ?>
                <tr> 
                  <td><?php echo $date;?></td>
                  <td><?php echo $foodname;?></td>
                  <td><?php echo $username;?></td>
                  <td><?php echo $rating;?></td>
                  <td><?php echo $feedback;?></td>
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