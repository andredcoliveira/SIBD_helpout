<?php

  include('../config/init.php');
  include('../database/users.php');

  $realname = strip_tags($_POST['realname']);
  $username = strip_tags($_POST['username']);
  $password = $_POST['passwd'];
  $password_bis = $_POST['passwd2'];
  $_SESSION['form_values'] = $_POST;

  if(!$realname) {
    $_SESSION['error_message'] = 'Invalid name';
    die(header('Location: ../index.php'));
  } elseif(!$username) {
    $_SESSION['error_message'] = "Invalid username";
    die(header('Location: ../index.php'));
  } elseif(!$password) {
    $_SESSION['error_message'] = "Invalid password";
    die(header('Location: ../index.php'));
  } elseif(!$password_bis || ($password_bis != $password)) {
    $_SESSION['error_message'] = "Passwords don't match";
    die(header('Location: ../index.php'));
  } else {
    try {
      createUser($realname, $username, $password);
    } catch(PDOException $e) {
      $_SESSION['error_message'] = $e->getMessage();
      die(header('Location: ../index.php'));
    }
  }

  $_SESSION['success_message'] = 'Your account was successfully created.';

  header('Location: ../index.php');
  exit();

?>
