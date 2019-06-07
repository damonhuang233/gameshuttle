<?php
  session_start();
  if (isset($_SESSION['currentUser'])){ header("location: account.php"); exit();}

  require_once "config.php";
  $UserName = $Password = "";
  $UserName_err = $Password_err = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $UserName = trim($_POST["UserName"]);
    if(empty($UserName)){
      $UserName_err = "Please enter UserName.";
    }
    $Password = trim($_POST["Password"]);
    if(empty($Password)){
      $Password_err = "Please enter Password.";
    }

    if(empty($UserName_err) && empty($Password_err)){
      $sql = "SELECT UserName, Password FROM Accounts WHERE UserName = '$UserName' AND Password = '$Password'";
      $result = mysqli_query($link, $sql);
      if($row = mysqli_fetch_assoc($result)){
        $_SESSION['currentUser'] = $UserName;
        header("location: account.php");
        exit();
      } else{
        $UserName_err = "Wrong user name or password.";
      }
      mysqli_free_result($result);
    }
    mysqli_close($link);
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Login</title>
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
            <li class="nav-item active">
                <a class="nav-link" href="#">Login</a>
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
                    <h2>Login</h2>
                </div>
                <p>Please enter the username and password to login.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($UserName_err)) ? 'has-error' : ''; ?>">
                        <label>UserName</label>
                        <input type="text" name="UserName" class="form-control" value="<?php echo $UserName; ?>">
                        <span class="help-block"><?php echo $UserName_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($Password)) ? 'has-error' : ''; ?>">
                        <label>Password</label>
                        <input type="text" name="Password" class="form-control" value="<?php echo $Password; ?>">
                        <span class="help-block"><?php echo $Password_err;?></span>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
  </body>
</html>
