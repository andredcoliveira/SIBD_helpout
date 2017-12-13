<div class="profile_wrapper">
  <div class="profile">

    <div class="new_request">
      <h2>Editar Pedido</h2>
      <form action="actions/action_edit_request.php" method="post" enctype="multipart/form-data">
        <label for="title"><h3 class="title">Título</h3></label><input type="text" name="title" value="<?php echo isset($_FORM_VALUES['title'])?$_FORM_VALUES['title']:$request['name']?>" placeholder="Título para o pedido">
        <label for="location"><h3 class="title">Localização</h3></label><input type="text" name="location" value="<?php echo isset($_FORM_VALUES['location'])?$_FORM_VALUES['location']:$request['location']?>" placeholder="Localização">
        <label for="date"><h3 class="title">Data</h3></label><input type="date" value="<?php echo isset($_FORM_VALUES['date'])?$_FORM_VALUES['date']:$request['date_limit']?>" name="date">
        <label for="reward"><h3 class="title">Recompensa</h3></label><input type="text" name="reward" value="<?php echo isset($_FORM_VALUES['reward'])?$_FORM_VALUES['reward']:$request['reward']?>" placeholder="Recompensa">
        <label for="description"><h3 class="title">Descrição</h3></label><textarea name="description" rows="4" cols="58"><?php echo isset($_FORM_VALUES['description'])?$_FORM_VALUES['description']:$request['description']?></textarea>

        <div class="choose_skills">
          <h3 class="title">Habilidades</h3>
          <?php foreach($skills as $skill) { ?>
            <div class="skill">
              <label><input type="checkbox" id="<?=$skill['id']?>" name="skills[]" value="<?=$skill['id']?>"><?=$skill['nome']?></label>
            </div>
          <?php } ?>
        </div>

        <label><strong>Escolha uma imagem:&nbsp;</strong>
          <input type="file" name="fileToUpload" id="fileToUpload">
        </label>

        <input type="submit" value="Submeter" name="submit">
      </form>
    </div>

  </div>
</div>
