<?php
  include ('../config/init.php');
  include ('../database/user.php');

  $username = strip_tags($_POST['username']);
  $password = $_POST['passwd'];

  if (!$username || !$password) {
    $_SESSION['error_message'] = 'All fields are mandatory!';
    $_SESSION['form_values'] = $_POST;
    die(header('Location: ../templates/login_register.php'));
  }

  try {
    createUser($username, $password);
    $_SESSION['success_message'] = 'User registered with success!';
  } catch (PDOException $e) {

    if (strpos($e->getMessage(), 'users_pkey') !== false)
      $_SESSION['error_message'] = 'Username already exists!';
    else
      $_SESSION['error_message'] = 'FAILLL!';

    $_SESSION['form_values'] = $_POST;
    die(header('Location: ../templates/login_register.php'));
  }

  header('Location: ../index.php');
?>
