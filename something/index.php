<?php
  include('config/init.php');
  include('templates/header.php');

  $realname = isset($_FORM_VALUES['realname'])?$_FORM_VALUES['realname']:'';
  $username = isset($_FORM_VALUES['username'])?$_FORM_VALUES['username']:'';

  include('templates/index.php');

  include('templates/footer.php');
?>
