<?php
  session_start();

  if (!isset($_SESSION['currentUser'])){
        header("location: login.php");
        exit();
  }

  require_once "config.php";
  $UserName = $_SESSION['currentUser'];

  $sql = "DELETE FROM CreditCard WHERE UserName = '$UserName'";

  if(mysqli_query($link, $sql)){
    header("location: account.php");
    exit();
  } else {
    header("location: error.php");
    exit();
  }

  mysqli_close($link);


?>
