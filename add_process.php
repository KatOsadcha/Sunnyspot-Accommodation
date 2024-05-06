<?php
  require_once('conn.php');

  // Add cabin
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cabin_type = $_POST['type'];
    $cabin_description = $_POST['description'];
    $price_per_night = $_POST['price_per_night'];
    $price_per_week = $_POST['price_per_week'];

    //Default image if no image provided
    $photo = "testCabin.jpg";

    // Upload an image if it is provided
    if ($_FILES["img"]["size"] > 0) {
      $target_direct = "images/";
      $target_file = $target_direct . basename($_FILES["img"]["name"]);
      $image_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      // Upload image file
      if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
        $photo = basename($_FILES["img"]["name"]);
      } else {
        die("Something went wrong while uploading an image. Please try again.");
      }
    } 

    // Inserting data
    $sql = "INSERT INTO `cabin` (`cabinType`, `cabinDescription`, `pricePerNight`, `pricePerWeek`, `photo`) VALUES ('$cabin_type','$cabin_description','$price_per_night','$price_per_week','$photo');";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      header('Location: cabin_list.php');
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
  }
?>