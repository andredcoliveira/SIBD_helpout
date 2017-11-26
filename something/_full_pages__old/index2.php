<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>HelpOut</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style2.css" rel="stylesheet">
  </head>
  <body>
    <header>
      <a href="index2.php" class="logo">
        <img src="helpout2.png" alt="HelpOut">
      </a>
      <div class="trigram_container">
        <a href="#open_nav" class="trigram_button">&#9776;</a>
      </div>
      <div id="open_nav" class="overlay">
        <div class="trigram_popup">
          <div class="trigram_container">
            <a href="#" class="trigram_button">&#9776;</a>
          </div>
          <ul class="header_navigation">
            <li><a href="index2.php" class="active">Pedidos</a></li>
            <li><a href="index2.php">Novo Pedido</a></li>
            <li><a href="index2.php">Perfil</a></li>
          </ul>
        </div>
      </div>
    </header>
    <main id="content">
      <a href="#show_sidebar" class="sidebar_colapsed">
        <span><strong>SHOW SIDEBAR</strong></span>
      </a>
      <aside id="show_sidebar" class="sidebar">
        <a href="#" class="photo_button">
          <section class="user_photo">
            <img src="user_photo.jpg" alt="User Photo">
          </section>
        </a>
        <section class="user_info">
          <h2>Carlos Ramalho</h2>
          <ul>
            <li>A ajudar: 2</li>
            <li>A pedir ajuda: 1</li>
          </ul>
        </section>
      </aside>
      <div class="post_grid">
        <?php for($i=0; $i<20; $i++) { ?>
          <a href="index2.php">
            <article class="post_request">
              <section class="post_img">
                <img src="estudar.jpg" alt="Request Photo">
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
      </div>
      <nav class="content_navigation">
        <ul>
          <li><a href="index2.php" class="active">1</a></li>
          <li><a href="index2.php">2</a></li>
          <li><a href="index2.php">3</a></li>
          <li><a href="index2.php">></a></li>
        </ul>
      </nav>
    </main>
    <footer>
      <p class='authors'>&copy; Daniel Granhão &amp; André Duarte 2017</p>
    </footer>
  </body>
</html>
