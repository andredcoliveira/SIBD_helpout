<?php
  include('config/init.php');
  include('database/comments.php');
  include('database/requests.php');
  include('database/users.php');
  include('tools/pages.php');
  include('tools/request.php');
  include('tools/user.php');

  if(!isset($_USERNAME)) {
    die(header('Location: index.php'));
  }

  include('templates/header.php');
  include('templates/sidebar.php');

  include('templates/edit_usr_profile.php');

  include('templates/footer.php');
?>
