<?php

  function createUser($realname, $username, $password) {
    global $conn;

    $options = [
      'cost' => 12,
    ];

    $hash = password_hash ($password , PASSWORD_DEFAULT, $options);

    $stmt = $conn->prepare('INSERT INTO users VALUES (DEFAULT, ?, ?, ?)');
    $stmt->execute(array($realname, $username, $hash));
  }

  function logUser($username, $password) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute(array($username));

    $userrow = $stmt->fetch();

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

    $stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
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

    $stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute(array($user_id));

    $userrow = $stmt->fetch();

    if($userrow !== false) {
      echo $userrow['description'];
    } else {
      return false;
    }
  }

  function editUser($name, $password, $date, $description, $user_id) {
    global $conn;

    $options = [
      'cost' => 12,
    ];

    $hash = password_hash($password , PASSWORD_DEFAULT, $options);

    $stmt = $conn->prepare('UPDATE users
                            SET name = ? , pw = ? , birthdate = ? , description = ?
                            WHERE id = ?');
    $stmt->execute(array($name, $hash, $date, $description, $user_id));

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
    if($i == 0) return 'Sem classificação';
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

    if($skills != null){
      foreach ($skills as $skill_id) {
        $stmt = $conn->prepare("INSERT INTO users_skill VALUES (?,?)");
        $stmt->execute(array($user_id, $skill_id));
      }
    }
  }

  function getUserSkills($user_id){
    global $conn;

    $stmt = $conn->prepare('SELECT nome
FROM users JOIN users_skill ON users.id = users_id JOIN skill ON skill_id = skill.id
WHERE users.id = ?');
    $stmt->execute(array($user_id));

    return $stmt->fetchAll();
  }

?>
