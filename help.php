<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Customer Support</title>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="account.php">My Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="showgame.php">Games</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Help</a>
          </li>
        </ul>
      </div>
      <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.php">Register</a>
            </li>
        </ul>
      </div>
    </nav>
  </head>
  <body>
    <div class="container">
      <h5> If you have any question, please contact the follwing locations: </h5>
      <?php
      require_once "config.php";
      $sql = "SELECT * FROM Warehouse";
      if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
          echo "<table class='table table-light table-hover'>";
              echo "<thead>";
                echo "<tr>";
                  echo "<th>Warehouse Number</th>";
                  echo "<th>State</th>";
                  echo "<th>City</th>";
                  echo "<th>Street</th>";
                echo "</tr>";
              echo "</thead>";
              echo "<tbody>";
              while($row = mysqli_fetch_array($result)){
                  echo "<tr>";
                    echo "<td>" . $row['wID'] . "</td>";
                    echo "<td>" . $row['State'] . "</td>";
                    echo "<td>" . $row['City'] . "</td>";
                    echo "<td>" . $row['Street'] . "</td>";
                  echo "</tr>";
              }
              echo "</tbody>";
            echo "</table>";
            mysqli_free_result($result);
        }
      }
      mysqli_close($link);
      ?>
    </div>
  </body>
</html>
