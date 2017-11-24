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
      <a href="http://www.google.com">
        <img src="helpout2.png" alt="HelpOut" class="logo">
      </a>
      <nav class="header_navigation">
        <a href="pedidos.php">Pedidos</a>
        <a href="novopedido.php">Novo Pedido</a>
        <a href="perfil.php">Perfil</a>
      </nav>
    </header>
    <main>
      <?php for($i=0; $i<20; $i++) { ?>
        <a href="http://www.google.com">
          <article>
            <section>
              <img src="estudar.jpg" alt="Estudar">
            </section>
            <section class="description">
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
      <p>&copy; Daniel Granhão e André Duarte 2017</p>
    </footer>
  </body>
</html>
