<?php
  session_start();
  if (!isset($_SESSION['currentUser'])){ header("location: account.php"); exit();}

  require_once "config.php";

  $sql = "SELECT COUNT(*) AS CountGame FROM Games";
  if($result = mysqli_query($link, $sql)){
    $row = mysqli_fetch_array($result);
    $Game_ID = $row['CountGame'] + 1;
  } else {
    echo "Warning: Fail to execute sql.";
  }

  $Game_Name = $Used = $buyPrice =$wID = "";
  $Game_Name_err = $Used_err = $buyPrice_err =$wID_err = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $Game_Name = trim($_POST["Game_Name"]);
    if(empty($Game_Name)){
      $Game_Name_err = "Please enter title of Game.";
    }
    $Used = trim($_POST["Used"]);
    if(empty($Used)){
      $Used_err = "Please enter T or F.";
    }
    $buyPrice = trim($_POST["buyPrice"]);
    if(empty($buyPrice)){
      $buyPrice_err = "Please enter the Price you want to sell.";
    }
    $wID = trim($_POST["wID"]);
    if(empty($wID)){
      $wID_err = "Please enter wID.";
    }

    if(empty($Game_Name_err) && empty($Used_err) && empty($buyPrice_err) && empty($wID_err)){
      $sql = "INSERT INTO Games VALUES (?, ?, ?, ?, ?, ?, ?)";
      if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "issiisi", $param_Game_ID, $param_Game_Name, $param_Used, $param_sellPrice, $param_buyPrice, $param_Sold, $param_wID);
        $param_Game_ID = $Game_ID;
        $param_Game_Name = $Game_Name;
        $param_Used = $Used;
        $param_sellPrice = $buyPrice + 5;
        $param_buyPrice = $buyPrice;
        $param_Sold = "F";
        $param_wID = $wID;

        if(mysqli_stmt_execute($stmt)){
           $sql = "INSERT INTO History VALUES (?, ?, ?, ?)";
          if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "siss", $param_UserName, $param_Game_ID, $param_type, $param_date);
            $param_UserName = $_SESSION['currentUser'];
            $param_Game_ID = $Game_ID;
            $param_type = "Sell";
            $param_date = date("Y-m-d");
            if(!mysqli_stmt_execute($stmt)){
              echo "Fail to add selling history.";
            }
          }
          header("location: success.php");
          exit();
        } else {
          echo "Fail to add game to Games table";
        }
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
                    <h2>Sell Game</h2>
                </div>
                <p>Please fill this form and submit to sell a game.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($Game_Name_err)) ? 'has-error' : ''; ?>">
                        <label>Game Title</label>
                        <input type="text" name="Game_Name" class="form-control" value="<?php echo $Game_Name; ?>">
                        <span class="help-block"><?php echo $Game_Name_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($Used_err)) ? 'has-error' : ''; ?>">
                        <label>Used (Enter T of F)</label>
                        <input type="text" name="Used" class="form-control" value="<?php echo $Used; ?>">
                        <span class="help-block"><?php echo $Used_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($buyPrice_err)) ? 'has-error' : ''; ?>">
                        <label>Price</label>
                        <input type="text" name="buyPrice" class="form-control" value="<?php echo $buyPrice; ?>">
                        <span class="help-block"><?php echo $buyPrice_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($wID_err)) ? 'has-error' : ''; ?>">
                        <label>wID (Enter 1 to 10)</label>
                        <input type="text" name="wID" class="form-control" value="<?php echo $wID; ?>">
                        <span class="help-block"><?php echo $wID_err;?></span>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a href="showgame.php" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
  </body>
</html>
