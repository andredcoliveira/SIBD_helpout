<html>
<?php include('../config/init.php');?>
  <head>
    <link rel="stylesheet" href="../css/login_style.css">
  </head>

  <body>

    <a href="#LoginRegister">Log in</a>

    <div id="LoginRegister" class="modalDialog">
      <div>
      		<a href="#close" title="Close" class="close">X</a>

          <p><strong>Entrar</strong></p>
          <form method="post" action="../actions/action_login.php">
            <input type="text" name="username" placeholder="utilizador" required><br>
            <input type="password" name="passwd" placeholder="palavra-passe" required><br>
            <input type="submit">
          </form>
          <p><strong>Registar</strong></p>
          <form method="post" action="../actions/action_register.php">
            <input type="text" name="realname" placeholder="nome"><br>
            <input type="text" name="username" placeholder="utilizador" required><br>
            <input type="password" name="passwd" placeholder="palavra-passe" required><br>
            <input type="text" name="address" placeholder="morada"><br>
            <input type="date" min="1900-01-01" max="2006-12-31"><br>
            <input type="submit">
          </form>
      	</div>
    </div>

  </body>
</html>
