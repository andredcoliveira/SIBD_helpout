<?php

	function newChat($request_id, $user_id) {
	    global $conn;

	    $stmt = $conn->prepare('INSERT INTO conversa VALUES (DEFAULT, ?) RETURNING id');
	    $stmt->execute(array($request_id));

      $chat_id = $stmt->fetch()['id'];

      $stmt = $conn->prepare('INSERT INTO users_conversa VALUES (?, ?)');
      $stmt->execute(array($user_id, $chat_id));

	    return true;
 	}


  function getChatIdByRequestId($request_id) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM conversa
                            WHERE pedido_id = ?');
    $stmt->execute(array($request_id));

    $chat = $stmt->fetch();

    return $chat;
  }

  function getMessages($chat_id) {
    global $conn;

    $stmt = $conn->prepare('SELECT users.id AS user_id, users.name AS user_name, message, time_sent 
                            FROM mensagem JOIN users ON sender_id = users.id
                            WHERE conversa_id = ?
                            ORDER BY time_sent DESC');
    $stmt->execute(array($chat_id));

    $messages = $stmt->fetchAll();

    return $messages;
  }

  function getRequestByChatId($chat_id) {
    global $conn;

    $stmt = $conn->prepare('SELECT pedido_id as id, name
                            FROM conversa JOIN pedido ON pedido_id = pedido.id
                            WHERE conversa.id = ?');
    $stmt->execute(array($chat_id));

    $chat = $stmt->fetch();

    return $chat;
  }

  function insertMessage($sender_id, $chat_id, $message){
    global $conn;

    $stmt = $conn->prepare('INSERT INTO mensagem VALUES(DEFAULT, ?, ?, ?, CURRENT_TIMESTAMP)');
    $stmt->execute(array($chat_id, $sender_id, $message));

    return true;
  }

  function belongsToChat($user_id, $chat_id) {
    global $conn;

    $stmt = $conn->prepare('SELECT *
                            FROM users_conversa
                            WHERE users_id = ? AND conversa_id = ?');
    $stmt->execute(array($user_id, $chat_id));

    $row = $stmt->fetch();

    if($row == false) return false;
    return true;
  }

  function enterChat($chat_id, $user_id){
    global $conn;

    $stmt = $conn->prepare('INSERT INTO users_conversa VALUES (?, ?)');
    $stmt->execute(array($user_id, $chat_id));

    return true;
  }

  function leaveChat($chat_id, $user_id){
    global $conn;

    $stmt = $conn->prepare('DELETE FROM users_conversa WHERE users_id = ? AND conversa_id = ?');
    $stmt->execute(array($user_id, $chat_id));

    return true;
  }  

?>
