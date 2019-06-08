<?php
  session_start();

  if (!isset($_SESSION['currentUser'])){
        header("location: login.php");
        exit();
  }

  require_once "config.php";
  $UserName = $_SESSION['currentUser'];
  $Game_ID = (int)$_GET['id'];

  $sql = "DELETE FROM Cart WHERE UserName = '$UserName' AND Game_ID = '$Game_ID'";

  if(mysqli_query($link, $sql)){
    header("location: cart.php");
    exit();
  } else {
    header("location: error.php");
    exit();
  }

  mysqli_close($link);


?>
