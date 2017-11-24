<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>HelpOut</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <link href="layout.css" rel="stylesheet">
  </head>
  <body>
    <header>
      <a href="index.php" class="logo">
        <img src="helpout2.png" alt="HelpOut">
      </a>
      <ul class="header_navigation">
        <li><a href="index.php" class="active">Pedidos</a></li>
        <li><a href="index.php">Novo Pedido</a></li>
        <li><a href="index.php">Perfil</a></li>
      </ul>
    </header>
    <main class="post_grid">
      <?php for($i=0; $i<20; $i++) { ?>
        <a href="index.php">
          <article class="post_request">
              <section class="post_img">
                <img src="estudar.jpg" alt="Estudar">
              </section>
              <section class="post_description">
              <h3>Preciso de ajuda a estudar!</h3>
                <ul>
                  <li>Gondomar</li>
                  <li>20/11/2017</li>
                  <li>1 Pessoa</li>
                </ul>
              </section>
          </article>
        </a>
      <?php } ?>
    </main>
    <footer>
      <p class='authors'>&copy; Daniel Granhão &amp; André Duarte 2017</p>
    </footer>
  </body>
</html>
