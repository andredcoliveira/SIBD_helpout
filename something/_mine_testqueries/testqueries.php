<?php

include('../config/init.php');
include('../database/users.php');

$user_id = 1;
$order[0]['name'] = 'reward';
$order[0]['type'] = 'ASC';
$order[1]['name'] = 'date_limit';
$order[1]['type'] = 'DESC';
$order[2]['name'] = 'name';
$order[2]['type'] = 'ASC';
$operator = 'OR';

$array = array();

$user_filters = getUserFilters($user_id);

$query = "SELECT DISTINCT id, ";

foreach($order as $column) {
  if($column != false) {
    $query = $query . $column['name'] . ", ";
  }
}
$query = substr($query, 0, -2);
$query = $query . " \n";

if($user_filters == false) {
  $query = $query . "FROM users_pedido JOIN pedido ON pedido_id = id
          WHERE active = true AND users_id != ? \n";
  $array = array($user_id);
} else {
  foreach($user_filters as $key => $filter) {
    if($key > 0) {
      if($operator == 'AND') {
        $query = $query . "\n INTERSECT \n\n";
      } elseif($operator == 'OR') {
        $query = $query . "\n UNION \n\n";
      } else {
        return -1;
      }
      $query = $query . "SELECT pedido_id
      FROM filters JOIN pedido_skill USING(skill_id) JOIN pedido ON pedido_id = id
      WHERE users_id = ? AND skill_id = ?) \n";
      $array = array_merge($array, array($user_id, $filter['skill_id']));
    } else {
      $query = $query . "FROM filters JOIN pedido_skill USING (skill_id) JOIN pedido ON pedido_id = id
          WHERE users_id = ? AND id IN (SELECT pedido_id
              FROM filters JOIN pedido_skill USING(skill_id) JOIN pedido ON pedido_id = id
              WHERE users_id = ? AND skill_id = ? \n";
      $array = array_merge($array, array($user_id, $user_id, $filter['skill_id']));
    }
  }
}

foreach($order as $key => $column) {
  if($key == 0) {
    $query = $query . "ORDER BY ";
  }
  if($column['name'] != false && $column['type'] != false) {
    $query = $query . $column['name'] . " " . $column['type'] . ", ";
  }
}
$query = substr($query, 0, -2);

$stmt = $conn->prepare($query);
$stmt->execute($array);

$requests = $stmt->fetchAll();


?>
