<?php

  include('../config/init.php');

  $stmt = $conn->prepare("INSERT INTO pedido
  VALUES (DEFAULT, 'nome', 'recompensa', '2017-12-24 23:59:59', 'descrição', 'local',  '2017-12-25')
  RETURNING id");
  $stmt->execute();

  $request_id = $stmt->fetch()['id'];

  print_r($request_id);

  $stmt = $conn->prepare("INSERT INTO users_pedido VALUES ('1', ?, 'true')");
  $stmt->execute(array($request_id));


?>
