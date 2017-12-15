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

  $skills = getAllSkills();

  $itemsPerPage = 12;
  
  if(isset($_GET['page'])) {
    $page = $_GET['page'];
  } else {
    $page = 1;
  }

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

  $requests = fillFeed($_ID, $operator, $order, $page, $itemsPerPage); //IDs only
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

  $numberOfPages = ceil(numberOfFeedRequests($_ID, $operator, $order) / $itemsPerPage);
  

  include('templates/header.php');
  include('templates/sidebar.php');

  include('templates/post_grid.php');

  include('templates/content_nav.php');
  include('templates/footer.php');
?>
