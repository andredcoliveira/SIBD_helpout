<?php

  include('../config/init.php');
  include('../database/users.php');

  try {
    deleteUser($_ID);
  } catch(PDOException $e) {
    $_SESSION['error_message'] = $e->getMessage();
    die(header('Location: ../edit_usr_profile.php'));
  }
  
  session_destroy();
  header('Location: ../index.php');
  exit();

?>
