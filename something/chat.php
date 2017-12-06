<?php
  include('config/init.php');
  include('database/requests.php');
  include('database/users.php');
  include('database/chat.php');
  include('tools/pages.php');
  include('tools/request.php');
  include('tools/user.php');

  if(!isset($_USERNAME)) {
    die(header('Location: index.php'));
  }

  $chat_id = $_GET['id'];

  if($chat_id == ''){
    $_SESSION['error_message'] = 'Chat inválido!';
    die(header("Location: index.php"));
  }
  
  try{
    $messages = getMessages($chat_id);
    $request = getRequestByChatId($chat_id);
    $owner = getRequestOwner($request['id']);
  } catch(PDOException $e) {
    $_SESSION['error_message'] = $e->getMessage();
    die(header("Location: index.php"));
  }

  $request_id = $request['id'];

  if(!belongsToChat($_ID, $chat_id)){
    $_SESSION['error_message'] = 'Não pode ver este chat pois não está a ajudar o pedido correspondente!';
    die(header("Location: request.php?id=$request_id"));
  }

  include('templates/header.php');
  include('templates/sidebar.php');

  include('templates/chat.php');

  include('templates/footer.php');
?>
