<?php
  include('../config/init.php');

  function isValidUser($username, $password) {
    global $conn;

    $stmt = $conn->prepare('SELECT * FROM accounts WHERE username = ?');
    $stmt->execute(array($username));

    $user = $stmt->fetch();

    return $user !== false && password_verify($password, $user['password']);
  }

  function createUser($username, $password) {
    global $conn;

    $options = [
        'cost' => 12,
    ];

    $hash = password_hash ($password , PASSWORD_DEFAULT, $options);

    $stmt = $conn->prepare('INSERT INTO accounts VALUES (DEFAULT, ?, ?)');
    $stmt->execute(array($username, $hash));
  }

?>
