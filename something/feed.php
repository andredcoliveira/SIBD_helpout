<?php
  include('config/init.php');

  if(!isset($_USERNAME)) {
    die(header('Location: index.php'));
  }

  $skills = getAllSkills();

  $order = false;
  $operator = 'OR';
  if(isset($_SESSION['feed_order']) && isset($_SESSION['feed_operator'])) {
    $order = $_SESSION['feed_order'];
    $operator = $_SESSION['feed_operator'];
  } elseif(isset($_SESSION['feed_order'])) {
    $order = $_SESSION['feed_order'];
  } elseif(isset($_SESSION['feed_operator'])) {
    $operator = $_SESSION['feed_operator'];
  }

  $requests = fillFeed($_ID, $operator, $order); //IDs only
  foreach($requests as $key => $request) {
    $requests[$key] = getRequest($request['id']);
  }

  if($requests != false && $requests != -1) {
    $k = 0;
    foreach($requests as $request) {
      $request_photo_paths[$k++] = getRequestPhoto($request['id']);
    }
    $k = 0;
  }

  include('templates/header.php');
  include('templates/sidebar.php');

  include('templates/post_grid.php');

  include('templates/content_nav.php');
  include('templates/footer.php');
?>
