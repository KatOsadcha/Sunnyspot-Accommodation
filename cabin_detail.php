<?php
  // Connect to database
  require_once('conn.php');

  $cabinID = $_POST['cabinID'];

  $sql = "SELECT * FROM cabin WHERE cabinID='{$cabinID}'";
  $result = mysqli_query($conn, $sql);

  if (!$result) {
    echo "Could not retrieve data";
  }

  $cabin = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sunny Spot Accommodation | Cabin detail</title>
  <link
      href="https://fonts.googleapis.com/css?family=Quando&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" type="text/css"  href="style.css"/>
  <style>
    #upd-image {
      object-fit: contain;
      margin-left: auto;
    }
  </style>
</head>
<body>
<header>
  
      <img src="images/accommodation.png" alt="Accommodation"/>
      <h1>Sunnyspot Accomodation</h1>
    </header>
  <div id="form-update-wrapper">
    
  <?php 
    echo "<img src='images/{$cabin['photo']}' width='300' height='300' alt='{$cabin['cabinType']}' id='upd-image'/>"
  ?>
  <!-- <br />
  <br />
  <br /> -->
  <form id="myForm" name="myForm" action="update_process.php" method="POST" enctype="multipart/form-data" id="form">
      <label for="img">Select image:</label>
      <?php 
        echo "<input type='file' id='img' name='img' accept='image/*'>";
      ?>
      <br />

      <label for="">Type</label>
      <?php 
        echo "<input type='text' name='type' value='{$cabin['cabinType']}' required />";
      ?>
      <br />

      <label for="">Description</label>
      <?php 
        echo "<input type='text' name='description' value='{$cabin['cabinDescription']}' required />";
      ?>
      <br />

      <label for="">Price per night</label>
      <?php 
        echo "<input type='number' id='price_per_night' name='price_per_night' min='0' value='{$cabin['pricePerNight']}' required />";
      ?>
      <br />

      <label for="">Price per week</label>
      <?php 
        echo "<input type='number' id='price_per_week' name='price_per_week' min='0' value='{$cabin['pricePerWeek']}' required />";
      ?>

      <?php 
        echo "<input type='hidden' name='photo' value='{$cabin['photo']}' />";
        echo "<input type='hidden' name='cabinID' value='{$cabin['cabinID']}' />";
        echo "<br>";
      ?>
      
      <button type="submit">Update</button>
  </form> 
  </div>
  <footer>
      <a href="cabin_list.php">Go Back</a>
    </footer>
  <script src="validate.js">
  </script>
</body>
</html>