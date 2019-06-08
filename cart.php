<?php
  session_start();

  if (!isset($_SESSION['currentUser'])){
        header("location: login.php");
        exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Game Shuttle</title>
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
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <nav class="navbar bg-white">
            <ul class="navbar-nav">
              <li class="nav-item">
                <h3>Account</h3>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="account.php">Account Information</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href=#> My Cart</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="history.php"> History</a>
              </li>
            </ul>
          </nav>
        </div>
       <div class="col-md-9" style="margin-top: 60px;">
  <div style="width=50%" class = "container">
    <p>Cart:</p>
    <?php
    require_once "config.php";
    $CurrentUser = ($_SESSION['currentUser']);
    $sql = "SELECT Game_Name, Used, sellPrice, wID FROM Games NATURAL JOIN Cart WHERE UserName='$CurrentUser'";
    if($result = mysqli_query($link, $sql)){
      if(mysqli_num_rows($result) > 0){
        echo "<table class='table table-light table-hover'>";
            echo "<thead>";
              echo "<tr>";
                echo "<th>Name</th>";
                echo "<th>Used</th>";
                echo "<th>Price</th>";
                echo "<th>wID</th>";
              echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($row = mysqli_fetch_array($result)){
		  echo "<tr>";
                  echo "<td>" . $row['Game_Name'] . "</td>";
                  echo "<td>" . $row['Used'] . "</td>";
                  echo "<td>" . $row['sellPrice'] . "</td>";
                  echo "<td>" . $row['wID'] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
          echo "</table>";
          echo "<a style='position:fixed;bottom:5px;right:5px;margin:10px;padding:15px 15px;' href='checkout.php' class='btn btn-info btn-md col-sm-1'><span class='glyphicon glyphicon-usd'></span>Checkout</a>";
          mysqli_free_result($result);
      } else {
        echo "<p><em>No records were found.</em></p>";
      }
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    mysqli_close($link);
     ?>
  </div>
      </div>
     </div>
    </div>
  </body>
</html>
