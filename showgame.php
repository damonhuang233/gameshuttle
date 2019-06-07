<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Games</title>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="account.php">My Account</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">Games</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="help.php">Help</a>
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
  <div class = "container">
    <?php
    require_once "config.php";
    $sql = "SELECT Game_ID, Game_Name, sellPrice, Used, wID FROM List_game";
    if($result = mysqli_query($link, $sql)){
      if(mysqli_num_rows($result) > 0){
        echo "<table class='table table-light table-hover'>";
            echo "<thead>";
              echo "<tr>";
                echo "<th>Name</th>";
                echo "<th>Used</th>";
                echo "<th>Price</th>";
                echo "<th>wID</th>";
                echo "<th></th>";
              echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                  echo "<td>" . $row['Game_Name'] . "</td>";
                  echo "<td>" . $row['Used'] . "</td>";
                  echo "<td>" . $row['sellPrice'] . "</td>";
                  echo "<td>" . $row['wID'] . "</td>";
                  echo "<td><a href='buygame.php?id=".$row['Game_ID']."'>Buy Now</a><td>";
                echo "</tr>";
            }
            echo "</tbody>";
          echo "</table>";
          mysqli_free_result($result);
      } else {
        echo "<p><em>No records were found.</em></p>";
      }
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    mysqli_close($link);
     ?>
     <a style="position:fixed;bottom:5px;right:5px;margin:10px;padding:15px 15px;" href="sellgame.php" class="btn btn-info btn-md col-sm-1">
       <span class="glyphicon glyphicon-usd"></span>Sell Game
     </a>
  </div>
</body>
</html>
