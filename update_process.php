<?php
  require_once('conn.php');

  // Update cabin
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cabin_type = $_POST['type'];
    $cabin_description = $_POST['description'];
    $price_per_night = $_POST['price_per_night'];
    $price_per_week = $_POST['price_per_week'];
    $photo = $_POST['photo'];
    $cabinID = $_POST['cabinID'];

    if ($_FILES["img"]["size"] > 0) {
      $target_direct = "images/";
      $target_file = $target_direct . basename($_FILES["img"]["name"]);
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      // Upload file to images folder
      if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
        $photo = basename($_FILES["img"]["name"]);
      } else {
        die("Something went wrong while uploading an image. Please try again.");
      }
    } 

    // Update data
    $sql = "UPDATE `cabin` SET `cabinType` = '$cabin_type', `cabinDescription` = '$cabin_description', `pricePerNight` = '$price_per_night', `pricePerWeek` = '$price_per_week', `photo` = '$photo' WHERE `cabin`.`cabinID` = $cabinID";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      header('Location: cabin_list.php');
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
  }

?>