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
  if(getRequestOwner($_CURR_REQ)['id'] != $_ID) {
    die(header('Location: request.php?id=' . $_CURR_REQ));
  }

  $skills = getAllSkills();

  $_SESSION['current_request'] = $_CURR_REQ;
  $request = getRequest($_CURR_REQ);

  include('templates/header.php');
  include('templates/sidebar.php');

  include('templates/edit_request.php');

  include('templates/footer.php');
?>
