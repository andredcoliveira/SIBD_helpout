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

  if(isset($_USERNAME)){
    $itemsPerPage = 12;

    if(isset($_GET['page'])) {
      $page = $_GET['page'];
    } else {
      $page = 1;
    }

    $requests = fillMatchFeed($_ID, $page, $itemsPerPage);
    foreach($requests as $key => $request) {
      $requests[$key] = getRequest($request['id']);
    }
    if($requests != false && $requests != -1) {
      $k = 0;
      foreach($requests as $request) {
        $request_photo_paths[$k++] = getRequestPhoto($request['id']);
      }
      $k = 0;
    } else {
      die(header('Location: feed.php'));
    }

    $numberOfPages = ceil(numberOfMatchFeedRequests($_ID) / $itemsPerPage);

    include('templates/post_grid.php');
    include('templates/content_nav_index.php');
  }

  include('templates/footer.php');
?>
