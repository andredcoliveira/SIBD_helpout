<?php
  include('config/init.php');
  include('tools/user.php');

  if(!isset($_USERNAME)) {
    die(header('Location: index.php'));
  }

  include('database/requests.php');
  $request_id = $_GET['id'];
  $request = getRequest($request_id);
  $request_owner = getRequestOwner($request_id);
  $owner_id = $request_owner['users_id'];
  
  $participants = getParticipants($request_id);


  include('templates/header.php');
  include('templates/sidebar.php');

  include('templates/request.php');

  include('templates/footer.php');
?>
