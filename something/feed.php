<?php
  include('config/init.php');
  include('database/requests.php');
  include('database/users.php');
  include('tools/request.php');
  include('tools/user.php');

  if(!isset($_USERNAME)) {
    die(header('Location: index.php'));
  }

  $skills = getAllSkills();

  $requests = fillFeed($_ID);

  if($requests != false) {
    $k = 0;
    foreach($requests as $request) {
      $request_photo_paths[$k++] = getRequestPhoto($request['id']);
    }
    $k = 0;
  }

  include('templates/header.php');
  include('templates/sidebar.php');

  //include('templates/feed.php');
  include('templates/post_grid.php');

  include('templates/content_nav.php');
  include('templates/footer.php');
?>
