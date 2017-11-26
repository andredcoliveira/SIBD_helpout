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

?>
