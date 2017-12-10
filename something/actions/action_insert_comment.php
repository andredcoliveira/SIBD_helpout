<?php

  include('../config/init.php');
  include('../database/comments.php');

  $comment = strip_tags($_POST['comment']);
  $commented_id = $_POST['user_id'];
  $classification = $_POST['stars'];
  $request_id = $_POST['request_id'];

  if(!$comment) {
    $_SESSION['error_message'] = 'Invalid comment!';
    die(header("Location: ../request.php?id=$request_id"));
  } elseif(!$classification) {
    $_SESSION['error_message'] = "No classification selected";
    die(header("Location: ../request.php?id=$request_id"));
  } else {
    try {
      insertComment($commented_id, $_ID, $request_id, $comment, $classification);
    } catch(PDOException $e) {
      $_SESSION['error_message'] = $e->getMessage();
      die(header("Location: ../request.php?id=$request_id"));
    }
  }

  $_SESSION['success_message'] = 'Comentário feito com sucesso!';

  header("Location: ../request.php?id=$request_id");
  exit();

?>
