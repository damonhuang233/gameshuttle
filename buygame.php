<?php
  session_start();
  if (!isset($_SESSION['currentUser'])){ header("location: account.php"); exit();}

  require_once "config.php";

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $sql = "INSERT INTO History VALUES (?, ?, ?, ?)";
    if($stmt = mysqli_prepare($link, $sql)){
      mysqli_stmt_bind_param($stmt, "siss", $param_UserName, $param_Game_ID, $param_type, $param_date);
      $param_UserName = $_SESSION['currentUser'];
      $param_Game_ID = (int)$_GET['id'];
      $param_type = "Buy";
      $param_date = date("Y-m-d");
      if(mysqli_stmt_execute($stmt)){
        header("location: success.php");
        exit();
      } else {
        echo "Error purchasing game.";
      }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
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
        <form method="post">
          <div class="form-group">
            <label> Address </label>
            <input type="text" name="Address" class="form-control">
          </div>
          <input type="submit" class="btn btn-primary" value="Submit">
          <a href="showgame.php" class="btn btn-default">Cancel</a>
        </form>
    </div>
  </body>
</html>
