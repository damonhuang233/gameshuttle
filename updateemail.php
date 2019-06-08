<?php
  session_start();

  if (!isset($_SESSION['currentUser'])){ header("location: account.php"); exit();}

  require_once "config.php";

  $UserName = $_SESSION['currentUser'];
  $Email = $Email_err = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $Email = trim($_POST["Email"]);
    if(empty($Email)){
      $Email_err = "Please enter Email.";
    }

    if(empty($Email_err)){
      $sql = "UPDATE Accounts SET Email = '$Email' WHERE UserName = '$UserName'";
      if(mysqli_query($link, $sql)){
        header("location: success.php");
        exit();
      } else {
        header("location: error.php");
        exit();
      }
    }
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
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Update Email</h2>
                </div>
                <p>Enter new Email</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($Email_err)) ? 'has-error' : ''; ?>">
                        <label>Email</label>
                        <input type="text" name="Email" class="form-control" value="<?php echo $Email; ?>">
                        <span class="help-block"><?php echo $Email_err;?></span>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
  </body>
</html>
