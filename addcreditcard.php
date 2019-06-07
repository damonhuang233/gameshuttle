<?php
  session_start();
  if (!isset($_SESSION['currentUser'])){ header("location: account.php"); exit();}

  require_once "config.php";
  $CardNum = $SecurityCode = $ExpriedDate = "";
  $CardNum_err = $SecurityCode_err = $ExpriedDate_err = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $CardNum = trim($_POST["CardNum"]);
    if(empty($CardNum)){
      $CardNum_err = "Please enter credit card number.";
    }
    $SecurityCode = trim($_POST["SecurityCode"]);
    if(empty($SecurityCode)){
      $SecurityCode_err = "Please enter security code.";
    }
    $ExpriedDate = trim($_POST["ExpriedDate"]);
    if(empty($ExpriedDate)){
      $ExpriedDate_err = "Please enter expried date.";
    }

    if(empty($CardNum_err) && empty($SecurityCode_err) && empty($ExpriedDate_err)){
      $sql = "INSERT INTO CreditCard VALUES (?, ?, ?, ?)";
      if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "siis", $param_CardNum, $param_SecurityCode, $param_ExpriedDate, $param_UserName);
        $param_CardNum = $CardNum;
        $param_SecurityCode = $SecurityCode;
        $param_ExpriedDate = $ExpriedDate;
        $param_UserName = $_SESSION['currentUser'];

        if(mysqli_stmt_execute($stmt)){
          header("location: success.php");
          exit();
        } else {
          $CardNum_err = "Credit Card already used by another account.";
        }
      } else {
        header("location: error.php");
      }
      mysqli_stmt_close($stmt);
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
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Add Credit Card</h2>
                </div>
                <p>Please fill this form and submit to add an credit card.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($CardNum_err)) ? 'has-error' : ''; ?>">
                        <label>Credit Card Number</label>
                        <input type="text" name="CardNum" class="form-control" value="<?php echo $CardNum; ?>">
                        <span class="help-block"><?php echo $CardNum_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($SecurityCode_err)) ? 'has-error' : ''; ?>">
                        <label>Security Code</label>
                        <input type="text" name="SecurityCode" class="form-control" value="<?php echo $SecurityCode; ?>">
                        <span class="help-block"><?php echo $SecurityCode_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($ExpriedDate_err)) ? 'has-error' : ''; ?>">
                        <label>Expried Date</label>
                        <input type="text" name="ExpriedDate" class="form-control" value="<?php echo $ExpriedDate; ?>">
                        <span class="help-block"><?php echo $ExpriedDate_err;?></span>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="index.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
  </body>
</html>
