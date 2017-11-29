<?php
  include('config/init.php');
  include('database/requests.php');
  include('tools/request.php');
  include('tools/user.php');

  if(!isset($_USERNAME)) {
    die(header('Location: index.php'));
  }

  if(isset($_GET['h'])) {
    $helping = $_GET['h'];
  } else {
    die(header('Location: my_requests.php?h=1'));
  }

  if($helping == 1) {
    $requests = getHelpingRequests($_ID, 0);
  } elseif($helping == 0) {
    $requests = getOwnedRequests($_ID, 0);
  } else {
    die(header('Location: my_requests.php?h=1'));
  }

  if($requests != false) {
    $k = 0;
    foreach($requests as $request) {
      $request_photo_paths[$k++] = getRequestPhoto($request['pedido_id']);
    }
    $k = 0;
  }

  $skills = getAllSkills();


  include('templates/header.php');
  include('templates/sidebar.php');

  include('templates/my_requests.php');
  include('templates/content_nav.php');

  include('templates/footer.php');
?>
