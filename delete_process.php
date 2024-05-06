<?php
  require_once('conn.php');

  // Delete cabin
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cabinID = $_POST['cabinID'];

    // Delete data
    $sql = "DELETE FROM `cabin` WHERE `cabin`.`cabinID` = {$cabinID}";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      header('Location: cabin_list.php');
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
  }

?>