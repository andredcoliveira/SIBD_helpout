<?php
  include('database/requests.php');

  $skills = getAllSkills();
?>


<div class="profile_wrapper">
  <div class="profile">

    <div class="new_request">
      <h2>Novo Pedido</h2>

      <form action="actions/action_new_request.php" method="post" enctype="multipart/form-data">
        <label for="title"><h3 class="title">Título</h3></label><input type="text" name="title" placeholder="Título para o pedido" required="required">
        <label for="location"><h3 class="title">Localização</h3></label><input type="text" name="location" placeholder="Localização" required="required">
        <label for="date"><h3 class="title">Data</h3></label><input type="date" name="date">
        <label for="reward"><h3 class="title">Recompensa</h3></label><input type="text" name="reward" placeholder="Recompensa">
        <label for="description"><h3 class="title">Descrição</h3></label><textarea name="description" rows="4" cols="58"></textarea>

        <div class="choose_skills">
          <h3 class="title">Habilidades</h3>
          <?php foreach($skills as $skill) { ?>
            <div class="skill">
              <label><input type="checkbox" id="<?=$skill['id']?>" name="skills[]" value="<?=$skill['id']?>"><?=$skill['nome']?></label>
            </div>
          <?php } ?>
        </div>

        <label>Escolha uma imagem:
          <input type="file" name="fileToUpload" id="fileToUpload">
        </label>

        <input type="submit" value="Submeter" name="submit">
      </form>
    </div>

  </div>
</div>
