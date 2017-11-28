<?php

  function getRequestPhoto($request_id) {
    $pattern = "res/uploads/requests/" . $request_id . ".*";
    if(isset(glob($pattern)[0])) {
      return glob($pattern)[0];
    }
    return false;
  }
  
  function getRequestPhoto2($request_id) {
    $pattern = "../res/uploads/requests/" . $request_id . ".*";
    if(isset(glob($pattern)[0])) {
      return glob($pattern)[0];
    }
    return false;
  }

?>
