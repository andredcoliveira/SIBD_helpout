<?php
  include('config/init.php');

  if(!isset($_USERNAME)) {
    die(header('Location: index.php'));
  }

  $request_id = $_GET['id'];
  $request = getRequest($request_id);
  $request_owner = getRequestOwner($request_id);
  $owner_id = $request_owner['users_id'];

  $participants = getParticipants($request_id);

  $skills = getAllSkills();

  include('templates/header.php');
  include('templates/sidebar.php');

  include('templates/request.php');

  include('templates/footer.php');
?>
