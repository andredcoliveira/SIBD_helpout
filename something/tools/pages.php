<?php

  function isPageActive($page) {
    $name = basename($_SERVER['PHP_SELF']);
    if($page == $name){
      echo 'active';
    }
  }

  function getCurrentPage() {
    $name = basename($_SERVER['PHP_SELF']);
    return $name;
  }

?>
