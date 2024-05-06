<?php
  session_start();

  // Checking whether the user is logged in
  if(!isset($_SESSION["userName"]) ){ 
    header('Location: login.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrative menu</title>
  <link
      href="https://fonts.googleapis.com/css?family=Quando&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" type="text/css"  href="style.css"/>
</head>
<body>
<header>
      <img src="images/accommodation.png" alt="Accommodation" />
      <h1>Sunnyspot Accomodation</h1>
    </header>
  <div id="add-wrapper">
    <div id="add-inner-wrapper">
      <form id="myForm" name="myForm" action="add_process.php" method="POST" enctype="multipart/form-data">
        <label for="img">Select image:</label>
        <input type="file" id="img" name="img" accept="image/*">
        <br />

        <label for="">Type</label>
        <input type="text" name="type" required />
        <br />

        <label for="">Description</label>
        <input type="text" name="description" required />
        <br />

        <label for="">Price per night</label>
        <input type="number" id="price_per_night" name="price_per_night" min="0" required />
        <br />

        <label for="">Price per week</label>
        <input type="number" id="price_per_week" name="price_per_week" min="0" required />
        <br />

        <button type="submit">Add</button>
      </form> 
    </div>
  </div>
  <footer>
      <a href="adminMenu.php">Go Back</a>
    </footer>
  <script src="validate.js">
  </script>
</body>
</html>
