<?php

  function getRequestPhoto($request_id) {
    if($request_id == false) return false;
    $pattern = "res/uploads/requests/" . $request_id . ".*";
    if(isset(glob($pattern)[0])) {
      return glob($pattern)[0];
    }
    return false;
  }

  function getRequestPhoto2($request_id) {
    if($request_id == false) return false;
    $pattern = "../res/uploads/requests/" . $request_id . ".*";
    if(isset(glob($pattern)[0])) {
      return glob($pattern)[0];
    }
    return false;
  }

?>
