<?php

  function insertRequest($title, $location, $date, $reward, $description, $skills) {
    global $_ID;
    global $conn;

    $stmt = $conn->prepare("INSERT INTO pedido
                  VALUES (DEFAULT, ?, ?, CURRENT_TIMESTAMP, ?, ?,  ?)
                  RETURNING id");
    $stmt->execute(array($title, $reward, $description, $location, $date));

    $request_id = $stmt->fetch()['id'];

    $stmt = $conn->prepare("INSERT INTO users_pedido VALUES ($_ID, ?, 'true')");
    $stmt->execute(array($request_id));

    if($skills != null){
      foreach ($skills as $skill_id) {
        $stmt = $conn->prepare("INSERT INTO pedido_skill VALUES (?,?)");
        $stmt->execute(array($request_id, $skill_id));
      }
    }
    
    return $request_id;
  }

  function getRequest($request_id) {
    global $conn;

    $stmt = $conn->prepare('SELECT *
                  FROM pedido
                  WHERE id = ?');
    $stmt->execute(array($request_id));

    return $stmt->fetch();

  }

  function getOwnedRequests($user_id, $limit) {
    global $conn;

    if($limit === 0) {
      $stmt = $conn->prepare('SELECT *
                    FROM pedido JOIN users_pedido ON (pedido.id = pedido_id)
                    WHERE users_id = ? AND users_pedido.owner = true');
      $stmt->execute(array($user_id));
    } else {
      $stmt = $conn->prepare('SELECT *
                    FROM pedido JOIN users_pedido ON (pedido.id = pedido_id)
                    WHERE users_id = ? AND users_pedido.owner = true
                    LIMIT ?');
      $stmt->execute(array($user_id, $limit));
    }

    $requests = $stmt->fetchAll();

    if($requests != false) {
      return $requests;
    }
    return false;
  }

  function getHelpingRequests($user_id, $limit) {
    global $conn;

    if($limit === 0) {
      $stmt = $conn->prepare('SELECT *
                        FROM pedido JOIN users_pedido ON (pedido.id = pedido_id)
                        WHERE users_id = ? AND users_pedido.owner = false');
      $stmt->execute(array($user_id));
    } else {
      $stmt = $conn->prepare('SELECT *
                        FROM pedido JOIN users_pedido ON (pedido.id = pedido_id)
                        WHERE users_id = ? AND users_pedido.owner = false
                        LIMIT ?');
      $stmt->execute(array($user_id, $limit));
    }

    $requests = $stmt->fetchAll();

    if($requests != false) {
      return $requests;
    }
    return false;
  }

  function getRequestOwner($request_id) {
    global $conn;

    $stmt = $conn->prepare('SELECT *
                  FROM users_pedido JOIN users ON (users_id = id)
                  WHERE owner = true AND pedido_id = ?');
    $stmt->execute(array($request_id));

    return $stmt->fetch();
  }

  function getAllSkills() {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM skill');
    $stmt->execute();


    $skills = $stmt->fetchAll();
    if($skills != false) return $skills;
    return false;
  }

?>
