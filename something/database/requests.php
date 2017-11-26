<?php

  function insertRequest($title, $location, $date, $reward, $description) {
    global $_ID;
    global $conn;

    $stmt = $conn->prepare("INSERT INTO pedido
    VALUES (DEFAULT, ?, ?, CURRENT_TIMESTAMP, ?, ?,  ?)
    RETURNING id");
    $stmt->execute(array($title, $reward, $description, $location, $date));

    $request_id = $stmt->fetch()['id'];

    $stmt = $conn->prepare("INSERT INTO users_pedido VALUES ($_ID, ?, 'true')");
    $stmt->execute(array($request_id));

    return $request_id;
  }

?>
