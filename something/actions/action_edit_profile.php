<?php

  include('../config/init.php');
  include('../database/users.php');

  $name = strip_tags($_POST['name']);
  $password = $_POST['pw'];
  $password_bis = $_POST['pw2'];
  $date = date('Y-m-d', strtotime($_POST['date']));
  $description = strip_tags($_POST['description']);

  if(!$name) {
    $_SESSION['error_message'] = 'Invalid name';
    die(header('Location: ../edit_usr_profile.php'));
  } elseif(!$password) {
    $_SESSION['error_message'] = "Invalid password";
    die(header('Location: ../edit_usr_profile.php'));
  } elseif(!$password_bis || ($password_bis != $password)) {
    $_SESSION['error_message'] = "Passwords don't match";
    die(header('Location: ../edit_usr_profile.php'));
  } else {
    try {
      editUser($name, $password, $date, $description);
    } catch(PDOException $e) {
      $_SESSION['error_message'] = $e->getMessage();
      die(header('Location: ../edit_usr_profile.php'));
    }
  }

  $_SESSION['success_message'] = 'Your account was successfully edited.';

  header('Location: ../usr_profile.php');
  exit();

?>
