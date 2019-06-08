<?php
  session_start();
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
            <a class="nav-link" href="#">Home</a>
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
      <h3> Welcome to GameShuttle</h3>
      <p>Popular Games</p>
      <div class="row">
        <div class="col">
          <p>Devil May Cry 5</p>
          <img src="pic\1.JPG" style="length:200px;height:300px;">
        </div>
        <div class="col">
          <p>Red Dead Redemption II</p>
          <img src="pic\2.JPG" style="length:200px;height:300px;">
        </div>
        <div class="col">
          <p>God of War</p>
          <img src="pic\3.JPG" style="length:200px;height:300px;">
        </div>
      </div>
    <div>
  </body>
</html>
