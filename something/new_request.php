<?php
  include('config/init.php');

  if(!isset($_USERNAME)) {
    die(header('Location: index.php'));
  }

  $skills = getAllSkills();

  include('templates/header.php');
  include('templates/sidebar.php');

  include('templates/new_request.php');

  include('templates/footer.php');
?>
