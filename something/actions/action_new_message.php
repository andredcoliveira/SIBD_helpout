<?php

  include('../config/init.php');
  include('../database/chat.php');

  $message = strip_tags($_POST['message']);
  $chat_id = $_POST['chat_id'];

  if(!$message) {
    $_SESSION['error_message'] = 'Mensagem inválida!';
    die(header("Location: ../chat.php?id=$chat_id"));
  } else {
    try {
      insertMessage($_ID, $chat_id, $message);
    } catch(PDOException $e) {
      $_SESSION['error_message'] = $e->getMessage();
      die(header("Location: ../chat.php?id=$chat_id"));
    }
  }

  $_SESSION['success_message'] = 'Mensagem enviada com sucesso!';

  header("Location: ../chat.php?id=$chat_id");
  exit();

?>
