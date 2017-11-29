<?php
  include('config/init.php');
  include('database/users.php');
  include('database/requests.php');
  include('database/comments.php');
  include('tools/user.php');
  include('tools/request.php');

  if(!isset($_USERNAME)) {
    die(header('Location: index.php'));
  }

  if(isset($_GET['id'])) {
    $user_id = $_GET['id'];
  } else {
    $user_id = $_ID;
  }
  $user_info = getUserInfo($user_id);
  $user_photo_path = getUserPhoto($user_id);
  $comments = recentCommentsToUser($user_id, 10); //limite = 10
  $requests = getOwnedRequests($user_id, 10); //limite = 10

  if($requests != false) {
    $k = 0;
    foreach($requests as $request) {
      $request_photo_paths[$k++] = getRequestPhoto($request['pedido_id']);
    }
    $k = 0;
  }

  $mySkills = getUserSkills($user_id);
  
  $skills = getAllSkills();


  include('templates/header.php');
  include('templates/sidebar.php');

  include('templates/usr_profile.php');

  include('templates/footer.php');
?>
