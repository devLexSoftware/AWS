<?php
  session_start();
  if ($_SESSION['valida'] != 'true') {
    session_destroy();
    header("location:../../login.php");
    exit();
  }
?>
