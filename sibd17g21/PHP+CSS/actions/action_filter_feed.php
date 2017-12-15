<?php

  include('../config/init.php');
  include('../database/users.php');
  include('../tools/pages.php');


  if(isset($_POST['skills'])){
    print_r($_POST['skills']);
    $skills = $_POST['skills']; // Array com id's de skills selecionadas
  }
  else $skills = NULL;

  try {
    updateFilters($_ID, $skills);
  } catch(PDOException $e) {
    $_SESSION['error_message'] = $e->getMessage();
    die(header("Location: ../" . getCurrentPage()));
  }

  if(isset($_POST['filter_type'])) {
    if($_POST['filter_type'] == 'any') {
      $_SESSION['feed_operator'] = 'OR';
    } elseif($_POST['filter_type'] == 'all') {
      $_SESSION['feed_operator'] = 'AND';
    }
  }

  if(isset($_POST['name'])) {
    $names = $_POST['name'];
    $i = 0;
    foreach($names as $name) {
      $order[$i++]['name'] = $name;
    }
  }

  if(isset($_POST['type'])) {
    $types = $_POST['type'];
    foreach($types as $key => $type) {
      foreach($order as $key_order => $tmp_order) {
        if($tmp_order['name'] == $key) {
          $order[$key_order]['type'] = $type;
        }
      }
    }
  }

  if(isset($_POST['priority'])) {
    $priorities = $_POST['priority'];
    foreach($priorities as $key => $priority) {
      foreach($order as $key_order => $tmp_order) {
        if($tmp_order['name'] == $key) {
          $order[$key_order]['priority'] = $priority;
        }
      }
    }
  }

  usort($order, function($a, $b) {
    return $a['priority'] - $b['priority'];
  });

  $_SESSION['feed_order'] = $order;

  header('Location: ../feed.php');
  exit();

?>
