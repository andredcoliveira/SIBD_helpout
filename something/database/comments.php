<?php

  function recentCommentsToUser($user_id, $limit) {
    global $conn;

    $stmt = $conn->prepare('SELECT users.name, comment.id, commenter_id, commented_id, comment.classification, comment, time_posted, pedido_id
                        FROM users JOIN comment ON (users.id = commenter_id)
                        WHERE commented_id = ?
                        ORDER BY time_posted DESC
                        LIMIT ?');
    $stmt->execute(array($user_id, $limit));

    return $stmt->fetchAll();

  }

  function getComment($user_id, $request_id){
    global $conn;

    $stmt = $conn->prepare('SELECT *
                            FROM comment
                            WHERE commented_id = ? AND pedido_id = ?');
    $stmt->execute(array($user_id, $request_id));

    return $stmt->fetch();
  }

  function insertComment($commented_id, $commenter_id, $request_id, $comment, $classification) {
    global $conn;

    $stmt = $conn->prepare('INSERT INTO comment
                            VALUES (DEFAULT, ?, ?, ?, ?, CURRENT_TIMESTAMP, ?)');
    $stmt->execute(array($commenter_id, $commented_id, $classification, $comment, $request_id));
  }

?>
