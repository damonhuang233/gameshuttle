<?php
  session_start();
  if (!isset($_SESSION['currentUser'])){
        header("location: login.php");
  } else {

  require_once "config.php";
  $UserName = $_SESSION['currentUser'];
  $sql = "SELECT Email FROM Accounts WHERE UserName = '$UserName'";
  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_array($result);
      $Email = $row['Email'];
      mysqli_free_result($result);
      } else {
      header("location: error.php");
    }
  } else {
  header("location: error.php");
 }

  $sql = "SELECT CardNum FROM CreditCard WHERE UserName = '$UserName'";
  if($result = mysqli_query($link, $sql)){
      if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $Card = $row['CardNum'];
        mysqli_free_result($result);
        } else {
        $Card = "<a href='addcreditcard.php'> Add a credit card </a>";
      }
    } else {
    header("location: error.php");
  }

  mysqli_close($link);
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>My account</title>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">My Account</a>
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
                <a class="nav-link" href="#">Account Information</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cart.php"> My Cart</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="history.php"> History</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="changepassword.php"> Change Password</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="updateemail.php"> Update Email</a>
              </li>
            </ul>
          </nav>
        </div>
       <div class="col-md-9" style="margin-top: 60px;">
         <p>UserName:</p>
         <p><?php echo $_SESSION['currentUser']?></p>
         <p>Email Address:</p>
         <p> <?php echo $Email ?></p>
         <p>Credit Card Number:</p>
         <p> <?php echo $Card ?></p>
      </div>
     </div>
    </div>
  </body>
</html>
