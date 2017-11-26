<div class="profile_wrapper">  
  <div class="profile">

    <div class="new_request">
      <h2>Editar Perfil</h2>

      <form action="actions/new_request.php" method="post" enctype="multipart/form-data">
        Nome:<input type="text" name="name" value="Daniel Granhão" required="required">
        Password:<input type="password" name="pw" required="required">
        Repita a Password:<input type="password" name="pw" required="required">
        Data de nascimento:<input type="date" name="date" value="1996-06-03">
        Descrição:<textarea rows="4" cols="64">Não me apetece.. </textarea>
        
        <label>Escolha uma foto de perfil:
          <input type="file" name="image">
        </label>
        <input type="submit" value="Submeter">
      </form>

      <form action="delete_account.php" method="post" id="delete_form">
        <input type="submit" value="Desativar Conta">
        <p>Ao desativar a sua conta ela deixará de estar<br>visivel até á proxima vez que efetue login.</p>
      </form>
    </div>
    
  </div>
</div>