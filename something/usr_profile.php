<?php
  include('config/init.php');

  if(!isset($_USERNAME)) {
    die(header('Location: index.php'));
  }

  include('templates/header.php');
  include('templates/sidebar.php');

  include('templates/usr_profile.php');

  include('templates/footer.php');
?>
