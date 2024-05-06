<?php
  session_start();

  // Checking whether the user is logged in
  if (isset($_SESSION['userName'])) {
    header('Location: adminMenu.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link
      href="https://fonts.googleapis.com/css?family=Quando&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" type="text/css"  href="style.css"/>
  <style>
    span {
      color: red;
    }
  </style>
</head>
<body>
    <header>
      <img src="images/accommodation.png" alt="Accommodation" />
      <h1>Sunnyspot Accomodation</h1>
    </header>
  <div id="form-wrapper">
    <h1>LOGIN</h1>
  <form action="processLogin.php" method="POST" id="form">
      <label for="userName">UserName: </label>
      <input type="text" name="userName" required />
      <br />

      <label for="password">Password: </label>
      <input type="password" name="password" required />
      <br />

      <?php
        if(isset($_SESSION["error_message"]) ){ 
          echo "<span>";
          echo $_SESSION["error_message"];
          echo "</span>";
          echo "<br>";
        }

        // Delete error message in session, so that it won't be visible when refreshing the page.
        unset($_SESSION['error_message']); 
      ?>

      <button type="submit">Login</button>
  </form>
  </div>
</body>
</html>