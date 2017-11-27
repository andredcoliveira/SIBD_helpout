<?php

  function getUserPhoto($user_id) {
    $pattern = "res/uploads/users/" . $user_id . ".*";
    if(isset(glob($pattern)[0])) {
      return glob($pattern)[0];
    }
    return false;
  }

?>
