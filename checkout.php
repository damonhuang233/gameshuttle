<?php
  session_start();
  if (!isset($_SESSION['currentUser'])){ header("location: account.php"); exit();}

  require_once "config.php";
  $CurrentUser = ($_SESSION['currentUser']);
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $sql = "CALL checkout('$CurrentUser')";
    if(mysqli_query($link, $sql)){
      header("location: success.php");
      exit();
    } else {
      header("location: error.php");
      exit();
    }
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
          <li class="nav-item active">
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
      <h2>Checkout</h2>
      <?php
      require_once "config.php";
      $CurrentUser = ($_SESSION['currentUser']);
      $sql = "SELECT Game_Name FROM Games NATURAL JOIN Cart WHERE UserName='$CurrentUser'";
      if($result = mysqli_query($link, $sql)){
        echo "<p>Game titles:</p>";
        while($row = mysqli_fetch_array($result)){
          echo "<p>" .$row['Game_Name']. "</p>";
        }
      } else {
        header("location: error.php");
      }
      $sql = "SELECT SUM(sellPrice) AS total FROM Games NATURAL JOIN Cart WHERE UserName='$CurrentUser'";
      if($result = mysqli_query($link, $sql)){
        $row = mysqli_fetch_array($result);
        echo "<p> Total: " .$row['total']. "$</p>";
      } else {
        header("location: error.php");
      }
      ?>
      <form method="post">
        <div class="form-group">
          <label> Address </label>
          <input type="text" name="Address" class="form-control">
        </div>
        <input type="submit" class="btn btn-primary" value="Submit">
        <a href="cart.php" class="btn btn-default">Cancel</a>
      </form>
    </div>
  </body>
</html>
