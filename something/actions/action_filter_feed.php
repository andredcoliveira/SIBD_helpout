<?php

  include('../config/init.php');
  include('../database/users.php');

  if(isset($_POST['skills'])){
    $skills = $_POST['skills']; /** Array com id's de skills selecionadas **/
  }
  else $skills = NULL;

  try {
    updateFilters($_ID, $skills);
  } catch(PDOException $e) {
    $_SESSION['error_message'] = $e->getMessage();
    die(header('Location: ../feed.php'));
  }

  header('Location: ../feed.php#show_sidebar');
  exit();

?>
