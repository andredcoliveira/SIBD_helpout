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
                    WHERE users_id = ? AND users_pedido.owner = true AND active = true');
      $stmt->execute(array($user_id));
    } else {
      $stmt = $conn->prepare('SELECT *
                    FROM pedido JOIN users_pedido ON (pedido.id = pedido_id)
                    WHERE users_id = ? AND users_pedido.owner = true AND active = true
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
                        WHERE users_id = ? AND users_pedido.owner = false AND active = true');
      $stmt->execute(array($user_id));
    } else {
      $stmt = $conn->prepare('SELECT *
                        FROM pedido JOIN users_pedido ON (pedido.id = pedido_id)
                        WHERE users_id = ? AND users_pedido.owner = false AND active = true
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

  function finishRequest($request_id) {
    global $conn;

    $stmt = $conn->prepare('UPDATE pedido SET active = FALSE WHERE id = ?');
    $stmt->execute(array($request_id));

    return true;
  }

  function startHelpingRequest($request_id, $user_id){
    global $conn;

    $stmt = $conn->prepare("INSERT INTO users_pedido VALUES (?, ?, 'false')");
    $stmt->execute(array($user_id, $request_id));

    return true;
  }

  function stopHelpingRequest($request_id, $user_id){
    global $conn;

    $stmt = $conn->prepare("DELETE FROM users_pedido WHERE users_id = ? AND pedido_id = ?");
    $stmt->execute(array($user_id, $request_id));

    return true;
  }

  function isHelping($request_id, $user_id){
    global $conn;

    $stmt = $conn->prepare('SELECT *
                  FROM users_pedido JOIN users ON (users_id = id)
                  WHERE owner = false AND pedido_id = ? AND users_id = ?');
    $stmt->execute(array($request_id, $user_id));


    $return_fetch = $stmt->fetch();
    if($return_fetch != NULL) return true;
    else return false;
  }

  function getParticipants($request_id){
    global $conn;

    $stmt = $conn->prepare('SELECT *
                  FROM users_pedido JOIN users ON (users_id = id)
                  WHERE owner = false AND pedido_id = ?');
    $stmt->execute(array($request_id));

    return $stmt->fetchAll();
  }

  function fillFeed($user_id, $operator, $order) {
    global $conn;

    $array = array();
    $query = "";

    $user_filters = getUserFilters($user_id);

    $select = "SELECT DISTINCT id, ";

    if($order != false) {
      foreach($order as $column) {
        if($column != false) {
          $select = $select . $column['name'] . ", ";
        }
      }
    }
    $select = substr($select, 0, -2);
    $select = $select . "\n";

    if($user_filters == false) {
      $query = "SELECT *\n" . "FROM users_pedido JOIN pedido ON pedido_id = id
      WHERE active = true AND users_id != ?  AND owner = true \n";
      $array = array_merge($array, array($user_id));
    } else {
      foreach($user_filters as $key => $filter) {
        if($key > 0) {
          if($operator == 'AND') {
            $query = $query . "\n\n INTERSECT \n\n";
          } elseif($operator == 'OR') {
            $query = $query . "\n\n UNION \n\n";
          } else {
            $_SESSION['error_message'] = "An error occured when fetching your feed.";
            return -1;
          }
          $query = $query . $select . "FROM users_pedido JOIN pedido ON pedido_id = id JOIN pedido_skill ON id = pedido_skill.pedido_id
                  WHERE active = true AND users_id != ? AND skill_id = ? AND owner = true";
          $array = array_merge($array, array($user_id, $filter['skill_id']));
        } else {
          $query = $query . $select . "FROM users_pedido JOIN pedido ON pedido_id = id JOIN pedido_skill ON id = pedido_skill.pedido_id
                  WHERE active = true AND users_id != ? AND skill_id = ? AND owner = true";
          $array = array_merge($array, array($user_id, $filter['skill_id']));
        }
      }
    }

    if($order != false) {
      foreach($order as $key => $column) {
        if($key == 0) {
          $query = "(" . $query . ")\nORDER BY ";
        }
        if($column['name'] != false && $column['type'] != false) {
          $query = $query . $column['name'] . " " . $column['type'] . ", ";
        }
      }
      $query = substr($query, 0, -2);
    }
    
    $stmt = $conn->prepare($query);
    $stmt->execute($array);

    $requests = $stmt->fetchAll();

    if($requests != false) return $requests;
    return false;
  }

  function deleteRequest($request_id){
    global $conn;

    $stmt = $conn->prepare('DELETE FROM pedido
                            WHERE id = ?');
    $stmt->execute(array($request_id));

    return true;
  }

?>
