<?php

  include('../config/init.php');
  include('../database/requests.php');
  include('../database/users.php');
  include('../tools/pages.php');

  if(isset($_POST['search_box'])) {
    $keyword = $_POST['search_box'];
  } else {
    $_SESSION['error_message'] = "An error occured with your search input.";
    if(isset($_POST['previous_page'])) {
      die(header('Location: ../' . $_POST['previous_page']));
    } else {
      die(header('Location: ../index.php'));
    }
  }

  $results = searchDB($keyword);

  if(isset($results[0])) {
    $_SESSION['results']['users'] = $results[0];
  }
  if(isset($results[1])) {
    $_SESSION['results']['requests'] = $results[1];
  }

  header('Location: ../search_result.php');

?>
