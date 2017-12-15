<?php

  function getUserPhoto($user_id) {
    if($user_id == false) return false;
    $pattern = "res/uploads/users/" . $user_id . ".*";
    if(isset(glob($pattern)[0])) {
      return glob($pattern)[0];
    }
    return false;
  }

  function getUserPhoto2($user_id) {
    if($user_id == false) return false;
    $pattern = "../res/uploads/users/" . $user_id . ".*";
    if(isset(glob($pattern)[0])) {
      return glob($pattern)[0];
    }
    return false;
  }

?>
