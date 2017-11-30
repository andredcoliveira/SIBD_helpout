<?php
  include('config/init.php');
  include('database/comments.php');
  include('database/requests.php');
  include('database/users.php');
  include('tools/pages.php');
  include('tools/request.php');
  include('tools/user.php');


  include('templates/header.php');

  $realname = isset($_FORM_VALUES['realname'])?$_FORM_VALUES['realname']:'';
  $username = isset($_FORM_VALUES['username'])?$_FORM_VALUES['username']:'';

  include('templates/index.php');

  include('templates/footer.php');
?>
