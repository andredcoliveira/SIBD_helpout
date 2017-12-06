<div class="profile_wrapper">
  <div class="profile">
    <?php if($_ID == $user_id) { ?>
      <a href="edit_usr_profile.php">Editar Perfil</a>
    <?php } ?>
    <div class="profile_top">
      <?php if($user_photo_path !== false) { ?>
        <div class="profile_pic_wrapper" style="background-image: url('<?=$user_photo_path?>');"></div>
      <?php } else { ?>
        <div class="profile_pic_wrapper" style="background-image: url('res/avatar.png');"></div>
      <?php } ?>
      <div class="profile_top_right">

        <h2><?=$user_info['name']?></h2>
        <div class="stars">
          <img src="res/star.png">
          <?php if(($score=getScore($user_id)) != -1) { ?>
            <span>&nbsp;&nbsp;<?=$score?></span>
          <?php } else { ?>
            <span class="no_score">&nbsp;&nbsp;Sem classificação.</span>
          <?php } ?>
        </div>
        <ul>
          <li>Profissão: <?php echo isset($user_info['profession'])? $user_info['profession']:'Não definido';?></li>
          <li>Localização: <?php echo isset($user_info['local'])? $user_info['local']:'Não definido';?></li>
        </ul>
      </div>
    </div>
    <div class="skills_profile_wrapper">
      <h3>As minhas especialidades</h3>
      <ul>
        <?php if($mySkills == FALSE) { ?>
          <span>Este utilizador ainda não escolheu especialidades.</span>
        <?php } else { foreach($mySkills as $mySkill) { ?>
          <li><?=$mySkill['nome']?></li>
        <?php } } ?>
      </ul>
    </div>
    <div class="description_wrapper">
      <h3>Descrição</h3>
      <p><?=$user_info['description']?></p>
    </div>

    <div class="recent_posts">
      <h3>Pedidos Recentes</h3>
      <?php include('templates/post_grid.php'); ?>
    </div>

    <?php include('templates/comments.php'); ?>

  </div>
</div>
