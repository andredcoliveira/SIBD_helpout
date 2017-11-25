<div class="visitor">
  <h1>Welcome to HelpOut!</h1>
  <div class="box">
  	<a class="button" href="#login">Login</a>
    <a class="button" href="#register">Register</a>
  </div>

  <div id="login" class="overlay">
  	<div class="popup">
  		<h2>Login</h2>
  		<a class="close" href="#/">&times;</a>
  		<div class="input_box">
        <form method="post" action="../actions/action_login.php">
          <input type="text" name="username" placeholder="utilizador" required><br>
          <input type="password" name="passwd" placeholder="palavra-passe" required><br>
          <input type="submit" value="Entrar">
        </form>
  		</div>
  	</div>
  </div>
  <div id="register" class="overlay">
    <div class="popup">
      <h2>Register</h2>
      <a class="close" href="#/">&times;</a>
      <div class="input_box ">
        <form method="post" action="../actions/action_register.php">
          <input type="text" name="realname" placeholder="Nome completo" required><br>
          <input type="text" name="username" placeholder="Nome de utilizador" required><br>
          <input type="email" name="email" placeholder="Endereço de e-mail" required><br>
          <input type="password" name="passwd" placeholder="Palavra-passe" required><br>
          <input type="password" name="passwd" placeholder="Repetir palavra-passe" required><br>
          <input type="submit" value="Registar">
        </form>
      </div>
    </div>
  </div>
</div>
