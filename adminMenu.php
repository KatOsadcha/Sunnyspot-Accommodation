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
  <div id="form-wrapper">
    <div id="form-inner-wrapper" class="adminMenu-wrap">
      <a href="add_cabin.php">Add cabin</a>
      <a href="cabin_list.php">Update or delete cabin</a>
      <form action="logout.php" action="POST">
        <button>Logout</button>
      </form>
    </div>
  </div>
</body>
</html>