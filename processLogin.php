<?php
  session_start();

  require_once('conn.php');

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $_POST['userName'];
    $password = $_POST['password'];

    // Redirect user to the login page, when the credential is provided
    if (is_null($user_name) || is_null($password)) {
      $_SESSION['error_message'] = 'Please check your UserName or Password';
      header('Location: login.php');
    }
    
    //Pull out an admin account based on the user input
    $sql = "SELECT * FROM admin WHERE userName='{$user_name}' AND password='{$password}'";
    $result = mysqli_query($conn, $sql);

    // Check if the query was performed properly
    if ($result) {

      // No user found
      if (mysqli_num_rows($result) == 0) {
        // When the provided credential is wrong
        $_SESSION['error_message'] = 'Please check your UserName or Password';
        header('Location: login.php');
      } else {
        // Store admin userName in session
        $admin = mysqli_fetch_assoc($result);
        $_SESSION['userName'] = $admin['userName'];
        header('Location: adminMenu.php');
      }
    }

    mysqli_close($conn);
  }
?>