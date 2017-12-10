<?php

  function createUser($realname, $username, $password) {
    global $conn;

    $options = [
      'cost' => 12,
    ];

    $hash = password_hash ($password , PASSWORD_DEFAULT, $options);

    $stmt = $conn->prepare('INSERT INTO users (id, name, username, pw)
                            VALUES (DEFAULT, ?, ?, ?)');
    $stmt->execute(array($realname, $username, $hash));
  }

  function logUser($username, $password) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($username));

    $userrow = $stmt->fetch();

    if($userrow['active'] === false) {
      $stmt = $conn->prepare('UPDATE users
                              SET active = true
                              WHERE username = ?');
      $stmt->execute(array($username));
    }

    return $userrow !== false && password_verify($password, $userrow['pw']);
  }

  function logUserById($user_id, $password) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute(array($user_id));

    $userrow = $stmt->fetch();

    if($userrow['active'] === false) {
      $stmt = $conn->prepare('UPDATE users
                              SET active = true
                              WHERE id = ?');
      $stmt->execute(array($user_id));
    }

    return $userrow !== false && password_verify($password, $userrow['pw']);
  }

  function getName($username) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($username));

    $userrow = $stmt->fetch();

    if($userrow !== false) {
      return $userrow['name'];
    } else {
      return false;
    }
  }

  function getID($username) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($username));

    $userrow = $stmt->fetch();

    if($userrow !== false) {
      return $userrow['id'];
    } else {
      return false;
    }
  }

  function getUserInfo($user_id) {
    global $conn;

    $stmt = $conn->prepare('SELECT * 
                            FROM users 
                            WHERE id = ? AND active = true');
    $stmt->execute(array($user_id));

    $userrow = $stmt->fetch();

    if($userrow !== false) {
      return $userrow;
    } else {
      return false;
    }
  }

  function getUserDescription($user_id) {
    global $conn;

    $stmt = $conn->prepare('SELECT * 
                            FROM users 
                            WHERE id = ? AND active = true');
    $stmt->execute(array($user_id));

    $userrow = $stmt->fetch();

    if($userrow !== false) {
      echo $userrow['description'];
    } else {
      return false;
    }
  }

  function editUser($name, $password, $date, $description, $user_id, $profession, $location) {
    global $conn;

    $options = [
      'cost' => 12,
    ];

    $hash = password_hash($password , PASSWORD_DEFAULT, $options);

    $stmt = $conn->prepare('UPDATE users
                            SET name = ? , pw = ? , birthdate = ? , description = ? , profession = ? , local = ? 
                            WHERE id = ?');
    $stmt->execute(array($name, $hash, $date, $description, $profession, $location, $user_id));

    return true;
  }

  function getScore($user_id) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM comment WHERE commented_id = ?');
    $stmt->execute(array($user_id));

    $comments = $stmt->fetchAll();

    $sum = 0;
    $i = 0;

    foreach ($comments as $comment) {
      $sum = $sum + $comment['classification'];
      $i = $i + 1;
    }
    if($i == 0) return -1;
    return round($sum / $i, 1);
  }

  function userHasSkill($user_id, $skill_id) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM users_skill WHERE users_id = ? AND skill_id = ?');
    $stmt->execute(array($user_id, $skill_id));

    $skill = $stmt->fetch();

    if($skill != NULL) return true;
    return false;
  }

  function editUserSkills($user_id, $skills){
    global $conn;

    $stmt = $conn->prepare("DELETE FROM users_skill WHERE users_id = ?");
    $stmt->execute(array($user_id));

    if($skills != null) {
      foreach ($skills as $skill_id) {
        $stmt = $conn->prepare("INSERT INTO users_skill VALUES (?,?)");
        $stmt->execute(array($user_id, $skill_id));
      }
    }
  }

  function getUserSkills($user_id) {
    global $conn;

    $stmt = $conn->prepare('SELECT nome
                  FROM users JOIN users_skill ON users.id = users_id JOIN skill ON skill_id = skill.id
                  WHERE users.id = ?');
    $stmt->execute(array($user_id));

    return $stmt->fetchAll();
  }

  function updateFilters($user_id, $skills) {
    global $conn;

    $stmt = $conn->prepare("DELETE FROM filters WHERE users_id = ?");
    $stmt->execute(array($user_id));

    if($skills != null) {
      foreach ($skills as $skill_id) {
        $stmt = $conn->prepare("INSERT INTO filters VALUES (?,?)");
        $stmt->execute(array($user_id, $skill_id));
      }
    }
  }

  function getUserFilters($user_id) {
    global $conn;

    $stmt = $conn->prepare('SELECT users_id, skill_id, nome
                  FROM filters JOIN skill ON skill_id = skill.id
                  WHERE users_id = ?');
    $stmt->execute(array($user_id));

    $filters = $stmt->fetchAll();
    if($filters != false) return $filters;
    return false;
  }

  function userHasFilter($user_id, $skill_id) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM filters WHERE users_id = ? AND skill_id = ?');
    $stmt->execute(array($user_id, $skill_id));

    $skill = $stmt->fetch();

    if($skill != NULL) return true;
    return false;
  }

  function searchDB($keyword) {
    global $conn;

    $query = "SELECT *
              FROM users
              WHERE users.active = true AND users.name ILIKE ?";

    $stmt = $conn->prepare($query);
    $stmt->execute(array("%" . $keyword . "%"));

    $results[0] = $stmt->fetchAll();

    $query = "SELECT DISTINCT pedido.*
              FROM pedido JOIN users_pedido ON pedido_id = pedido.id
              JOIN users ON users_id = users.id
              WHERE users.active = true AND pedido.name ILIKE ?";

    $stmt = $conn->prepare($query);
    $stmt->execute(array("%" . $keyword . "%"));

    $results[1] = $stmt->fetchAll();

    if($results != false) return $results;
    return false;
  }

  function deleteUser($user_id) {
    global $conn;

    $stmt = $conn->prepare("UPDATE users
                            SET active = false
                            WHERE id = ?");
    $stmt->execute(array($user_id));
  }

?>
