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

?>
