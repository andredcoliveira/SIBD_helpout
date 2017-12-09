<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>HelpOut</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <header>
      <a href="index.php" class="logo">
        <img src="res/logo.png" alt="HelpOut">
      </a>
      <!-- check if user logged in before showing this -->
      <?php if(isset($_SESSION['username'])) { ?>
        <div class="trigram_container">
          <a href="#open_nav" class="trigram_button">&#9776;</a>
        </div>
        <div id="open_nav" class="overlay">
          <div class="trigram_popup">
            <div class="trigram_container">
              <a href="#/" class="trigram_button">&#9776;</a>
            </div>
            <ul class="header_navigation">
              <li><a href="index.php" class="<?php isPageActive('index.php')?>">Página Inicial</a></li>
              <li><a href="feed.php" class="<?php isPageActive('feed.php');?>">Ajudar</a></li>
              <li><a href="my_requests.php" class="<?php isPageActive('my_requests.php');?>">Meus Pedidos</a></li>
              <li><a href="new_request.php" class="<?php isPageActive('new_request.php');?>">Novo Pedido</a></li>
              <li><a href="usr_profile.php" class="<?php isPageActive('usr_profile.php');?>">Perfil</a></li>
              <li><a href="actions/action_logout.php" class="logout">Sair</a></li>
            </ul>
          </div>
        </div>
      <?php } ?>
      <!-- ends here -->
    </header>
    <?php if(isset($_ERROR_MESSAGE) || isset($_SUCCESS_MESSAGE)) { ?>
      <aside class="success_error">
        <?php if(isset($_ERROR_MESSAGE)) { ?>
          <h3>ERROR</h3>
          <div id="error"><?=$_ERROR_MESSAGE?></div>
        <?php } elseif(isset($_SUCCESS_MESSAGE)) { ?>
          <div id="success"><?=$_SUCCESS_MESSAGE?></div>
        <?php } ?>
      </aside>
    <?php } ?>
    <main id="content">
