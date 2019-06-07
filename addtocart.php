<?php
  session_start();

  if (!isset($_SESSION['currentUser'])){
        header("location: login.php");
        exit();
  }
?>
