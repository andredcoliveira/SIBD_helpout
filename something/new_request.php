<?php
  include('config/init.php');
  include('database/requests.php');
  include('tools/request.php');
  include('tools/user.php');

  if(!isset($_USERNAME)) {
    die(header('Location: index.php'));
  }

  $skills = getAllSkills();

  include('templates/header.php');
  include('templates/sidebar.php');

  include('templates/new_request.php');

  include('templates/footer.php');
?>
