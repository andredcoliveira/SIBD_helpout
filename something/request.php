<?php
  include('config/init.php');
  include('tools/user.php');
  include('tools/request.php');

  if(!isset($_USERNAME)) {
    die(header('Location: index.php'));
  }

  include('database/requests.php');
  include('database/comments.php');
  include('database/users.php');
  
  $request_id = $_GET['id'];
  try{
    $request = getRequest($request_id);
    $request_owner = getRequestOwner($request_id);
    $participants = getParticipants($request_id);
    $skills = getAllSkills();
  } catch(PDOException $e) {
    $_SESSION['error_message'] = $e->getMessage();
    die(header("Location: index.php"));
  }
  
  $owner_id = $request_owner['users_id'];

  

  

  include('templates/header.php');
  include('templates/sidebar.php');

  include('templates/request.php');

  include('templates/footer.php');
?>
