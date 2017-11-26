<?php

  include('../config/init.php');
  include('../database/users.php');

  $username = $_POST['username'];
  $password = $_POST['passwd'];

  if(!$username) {
    $_SESSION['error_message'] = "Invalid username";
    die(header('Location: ../index.php'));
  } elseif(!$password) {
    $_SESSION['error_message'] = "Invalid password";
    die(header('Location: ../index.php'));
  } else {
    if(logUser($username, $password)){
      $_SESSION['success_message'] = 'Logged in.';
      $_SESSION['username'] = $username;
      $_SESSION['name'] = getName($username);
    } else {
      $_SESSION['error_message'] = "Login failed";
      die(header('Location: ../index.php'));
    }
  }

  header('Location: ../index.php');
  exit();

?>
