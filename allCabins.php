<?php
  // Connect to database
  require_once('conn.php');

  // Query to retrieve data
  $sql = "SELECT * FROM cabin";

  // Execute a query
  $cabins = mysqli_query($conn, $sql);

  if (!$cabins) {
    echo "Could not retrieve data";
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sunnyspot Accommodation</title>
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

    <section>
      <?php 
        while($cabin = mysqli_fetch_array($cabins)) {
          echo "<article>";
          echo "<h2>" . $cabin["cabinType"] . "</h2>";
          echo "<img src='images" . "/" . $cabin['photo'] . "' " . "alt='" . $cabin['cabinType']. "'" . "/>";
          echo "<p><span>Details: </span>" . $cabin['cabinDescription'] ."</p>";
          echo "<p><span>Price per night: </span>" . $cabin['pricePerNight'] . "</p>";
          echo "<p><span>Price per week: </span>" . $cabin['pricePerWeek'] . "</p>";
          echo "</article>";
        }
      ?>
    </section>

    <footer>
      <a href="adminMenu.php">Admin</a>
    </footer>
  </body>
</html>
