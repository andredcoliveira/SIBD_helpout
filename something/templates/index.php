<div class="visitor">
  <?php if(!isset($_USERNAME)) { ?>
    <h1>Bem-vindo ao HelpOut!</h1>
    <div class="box">
      <a class="button" href="#login">Entrar</a>
      <a class="button" href="#register">Registar</a>
    </div>

    <div id="login" class="overlay">
      <div class="popup">
        <a class="close" href="#/">&times;</a>
        <h2>Entrar</h2>
        <div class="input_box">
          <form method="post" action="actions/action_login.php">
            <input type="text" name="username" placeholder="Nome de utilizador" value="<?=$username?>" required><br>
            <input type="password" name="passwd" placeholder="Palavra-passe" required><br>
            <input type="submit" value="Entrar">
          </form>
        </div>
      </div>
    </div>
    <div id="register" class="overlay">
      <div class="popup">
        <a class="close" href="#/">&times;</a>
        <h2>Registar</h2>
        <div class="input_box ">
          <form method="post" action="actions/action_register.php">
            <input type="text" name="realname" placeholder="Nome completo" value="<?=$realname?>" required><br>
            <input type="text" name="username" placeholder="Nome de utilizador" value="<?=$username?>" required><br>
            <!--<input type="email" name="email" placeholder="Endereço de e-mail"><br>-->
            <input type="password" name="passwd" placeholder="Palavra-passe" required><br>
            <input type="password" name="passwd2" placeholder="Repetir palavra-passe" required><br>
            <input type="submit" value="Registar">
          </form>
        </div>
      </div>
    </div>
  <?php } else { ?>
    <h1>Bem-vindo de volta!</h1>
  <?php } ?>
</div>
