<?php
  $allSkills = getAllSkills();
?>

<div class="profile_wrapper">
  <div class="profile">

    <div class="new_request">
      <h2>Editar Perfil</h2>

      <form action="actions/action_edit_profile.php" method="post" enctype="multipart/form-data">
        <label for="name"><h3 class="title">Nome:</h3></label><input type="text" name="name" value="Daniel Granhão" required="required">
        <label for="pw"><h3 class="title">Password:</h3></label><input type="password" name="pw" required="required">
        <label for="pw2"><h3 class="title">Repita a Password:</h3></label><input type="password" name="pw2" required="required">
        <label for="date"><h3 class="title">Data de nascimento:</h3></label><input type="date" name="date" value="1996-06-03">
        <label for="description"><h3 class="title">Descrição:</h3></label><textarea rows="4" cols="64" name="description" id="edit_profile_description">Não me apetece.. </textarea>

        <div class="choose_skills">
          <h3 class="title">Habilidades:</h3>
          <?php foreach($allSkills as $skill) { ?>
            <div class="skill">
              <label><input type="checkbox" id="<?=$skill['id']?>" name="skills[]" value="<?=$skill['id']?>" <?php echo (userHasSkill($_ID, $skill['id'])? 'checked' : '')?>><?=$skill['nome']?></label>
            </div>
          <?php } ?>
        </div>


        <label>Escolha uma foto de perfil:
          <input type="file" name="fileToUpload" id="fileToUpload">
        </label>
       
        <input type="submit" value="Submeter" name="submit" id="submit_button_edit_profile">
      </form>

      <form action="actions/action_delete_account.php" method="post" id="delete_form">
        <input type="submit" value="Desativar Conta">
        <p>Desativar a sua conta fará com que ela deixe de estar visível até à proxima vez que efetuar login.</p>
      </form>
    </div>

  </div>
</div>
