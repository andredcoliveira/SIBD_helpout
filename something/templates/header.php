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
      <div class="trigram_container">
        <a href="#open_nav" class="trigram_button">&#9776;</a>
      </div>
      <div id="open_nav" class="overlay">
        <div class="trigram_popup">
          <div class="trigram_container">
            <a href="#/" class="trigram_button">&#9776;</a>
          </div>
          <ul class="header_navigation">
            <li><a href="index.php" class="active">Pedidos</a></li>
            <li><a href="index.php">Novo Pedido</a></li>
            <li><a href="index.php">Perfil</a></li>
          </ul>
        </div>
      </div>
      <!-- ends here -->
    </header>
    <main id="content">
