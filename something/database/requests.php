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

  function updateRequest($request_id, $title, $location, $date, $reward, $description, $skills) {
    global $_ID;
    global $conn;

    if(getRequestOwner($request_id)['id'] != $_ID) {
      return false;
    }

    $query = "UPDATE pedido\nSET";
    $array = array();

    $stuffz = array('name' => $title, 'reward' => $reward, 'description' => $description,
     'location' => $location, 'date_limit' => $date);

    foreach($stuffz as $key => $stuff) {
      if($stuff != false) {
        $query = $query . " " . $key . " = ?,";
        $array = array_merge($array, array($stuff));
      }
    }
    $query = substr($query, 0, -1);
    $query = $query . "\nWHERE id = ?";
    $array = array_merge($array, array($pedido_id));

    $stmt = $conn->prepare($query);
    $stmt->execute($array);

    if($skills != null){
      $stmt = $conn->prepare("DELETE FROM pedido_skill WHERE pedido_id = ?");
      $stmt->execute(array($request_id));
      foreach ($skills as $skill_id) {
        $stmt = $conn->prepare("INSERT INTO pedido_skill VALUES (?,?)");
        $stmt->execute(array($request_id, $skill_id));
      }
    }

    return true;
  }

  function getRequest($request_id) {
    global $conn;

    $stmt = $conn->prepare('SELECT pedido.*
                            FROM pedido JOIN users_pedido ON pedido_id = pedido.id
                            JOIN users ON users_id = users.id
                            WHERE users.active = true AND pedido.id = ?');
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
      $stmt = $conn->prepare('SELECT pedido.* , pedido_id
                              FROM pedido JOIN users_pedido ON (pedido.id = pedido_id) JOIN users ON users_id = users.id
                              WHERE users.active = true AND users_id = ? AND users_pedido.owner = false AND pedido.active = true');
      $stmt->execute(array($user_id));
    } else {
      $stmt = $conn->prepare('SELECT pedido.* , pedido_id
                              FROM pedido JOIN users_pedido ON (pedido.id = pedido_id) JOIN users ON users_id = users.id
                              WHERE users.active = true AND users_id = ? AND users_pedido.owner = false AND pedido.active = true
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

  function fillFeed($user_id, $operator, $order, $page, $itemsPerPage) {
    global $conn;

    $array = array();
    $query = "";

    $user_filters = getUserFilters($user_id);

    $select = "SELECT DISTINCT pedido.id, ";

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
      $query = "SELECT users_pedido.* , pedido.* \n" . "FROM users_pedido JOIN pedido ON pedido_id = pedido.id JOIN users ON users_id = users.id
      WHERE users.active = true AND pedido.active = true AND users_id != ?  AND owner = true \n";
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
          $query = $query . $select . "FROM users_pedido JOIN pedido ON pedido_id = pedido.id JOIN pedido_skill ON pedido.id = pedido_skill.pedido_id JOIN users ON users_id = users.id
                  WHERE users.active = true AND pedido.active = true AND users_id != ? AND skill_id = ? AND owner = true";
          $array = array_merge($array, array($user_id, $filter['skill_id']));
        } else {
          $query = $query . $select . "FROM users_pedido JOIN pedido ON pedido_id = pedido.id JOIN pedido_skill ON pedido.id = pedido_skill.pedido_id JOIN users ON users_id = users.id
                  WHERE users.active = true AND pedido.active = true AND users_id != ? AND skill_id = ? AND owner = true";
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

    $offset = $itemsPerPage * ($page - 1);
    $query = '(' . $query . ") LIMIT $itemsPerPage OFFSET $offset";

    $stmt = $conn->prepare($query);
    $stmt->execute($array);

    $requests = $stmt->fetchAll();

    if($requests != false) return $requests;
    return false;
  }

  function numberOfFeedRequests($user_id, $operator, $order) {
        global $conn;

    $array = array();
    $query = "";

    $user_filters = getUserFilters($user_id);

    $select = "SELECT DISTINCT pedido.id, ";

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
      $query = "SELECT users_pedido.* , pedido.* \n" . "FROM users_pedido JOIN pedido ON pedido_id = pedido.id JOIN users ON users_id = users.id
      WHERE users.active = true AND pedido.active = true AND users_id != ?  AND owner = true \n";
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
          $query = $query . $select . "FROM users_pedido JOIN pedido ON pedido_id = pedido.id JOIN pedido_skill ON pedido.id = pedido_skill.pedido_id JOIN users ON users_id = users.id
                  WHERE users.active = true AND pedido.active = true AND users_id != ? AND skill_id = ? AND owner = true";
          $array = array_merge($array, array($user_id, $filter['skill_id']));
        } else {
          $query = $query . $select . "FROM users_pedido JOIN pedido ON pedido_id = pedido.id JOIN pedido_skill ON pedido.id = pedido_skill.pedido_id JOIN users ON users_id = users.id
                  WHERE users.active = true AND pedido.active = true AND users_id != ? AND skill_id = ? AND owner = true";
          $array = array_merge($array, array($user_id, $filter['skill_id']));
        }
      }
    }

    $stmt = $conn->prepare($query);
    $stmt->execute($array);

    $requests = $stmt->fetchAll();
    return count($requests);

  }

  function deleteRequest($request_id){
    global $conn;

    $stmt = $conn->prepare('DELETE FROM pedido
                            WHERE id = ?');
    $stmt->execute(array($request_id));

    return true;
  }

  function getRequestSkills($request_id) {
    global $conn;

    $stmt = $conn->prepare('SELECT nome
                  FROM pedido JOIN pedido_skill ON pedido.id = pedido_id JOIN skill ON skill_id = skill.id
                  WHERE pedido.id = ?');
    $stmt->execute(array($request_id));

    return $stmt->fetchAll();
  }

  function fillMatchFeed($user_id, $page, $itemsPerPage) {
    global $conn;

    $offset = $itemsPerPage * ($page - 1);

    $stmt = $conn->prepare('SELECT COUNT(*), pedido.id
                            FROM pedido
                            JOIN pedido_skill ON pedido_id = pedido.id
                            JOIN users_skill ON users_skill.skill_id = pedido_skill.skill_id
                            JOIN users_pedido ON users_pedido.pedido_id = pedido.id AND owner = true
                            JOIN users ON users.id = users_pedido.users_id
                            WHERE users_skill.users_id = ? AND pedido.active = true AND users_pedido.users_id != ? AND users.active = true
                            GROUP BY(pedido.id)
                            ORDER BY count DESC
                            LIMIT ? OFFSET ?');
    $stmt->execute(array($user_id, $user_id, $itemsPerPage, $offset));

    return $stmt->fetchAll();
  }

  function numberOfMatchFeedRequests($user_id){
    global $conn;

    $stmt = $conn->prepare('SELECT COUNT(*), pedido.id
                            FROM pedido
                            JOIN pedido_skill ON pedido_id = pedido.id
                            JOIN users_skill ON users_skill.skill_id = pedido_skill.skill_id
                            JOIN users_pedido ON users_pedido.pedido_id = pedido.id AND owner = true
                            JOIN users ON users.id = users_pedido.users_id
                            WHERE users_skill.users_id = ? AND pedido.active = true AND users_pedido.users_id != ? AND users.active = true
                            GROUP BY(pedido.id)');
    $stmt->execute(array($user_id, $user_id));

    return count($stmt->fetchAll());
  }

?>
