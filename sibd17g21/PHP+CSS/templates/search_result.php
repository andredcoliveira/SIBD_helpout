<?php

  if(isset($_RESULTS['users'])) { ?>
    <h3>Utilizadores encontrados:</h3>
    <?php $users = $_RESULTS['users'];
    $k = 0;
    foreach($users as $user) {
      $user_photo_paths[$k++] = getUserPhoto($user['id']);
    }
    $k = 0;
    include('user_post_grid.php');
  }
  if(isset($_RESULTS['requests'])) { ?>
    <h3>Pedidos encontrados:</h3>
    <?php $requests = $_RESULTS['requests'];
    $k = 0;
    foreach($requests as $request) {
      $request_photo_paths[$k++] = getRequestPhoto($request['id']);
    }
    $k = 0;
    include('post_grid.php');
  }
  if(!isset($_RESULTS['users']) && !isset($_RESULTS['requests'])) { ?>
    <h3>Não foram obtidos resultados na busca.</h3>
  <?php }

?>
