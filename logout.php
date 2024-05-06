<?php
  session_start();

  session_destroy();

  header('Location: allCabins.php');
?>