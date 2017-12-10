      <div class="post_grid">
        <?php if($users != false && $users != -1) {
          foreach($users as $key => $user) { ?>
            <a href="usr_profile.php?id=<?=$user['id']?>">
              <article class="post_request">
                <?php if($user_photo_paths[$key] !== false) { ?>
                  <img class="post_img_wrapper" src="<?=$user_photo_paths[$key]?>">
                <?php } else {?>
                  <img class="post_img_wrapper" src="res/avatar.png">
                <?php }?>
                <section class="post_description">
                  <h3><?=$user['name']?></h3>
                  <ul>
                    <li><?=$user['profession']?></li>
                    <li><?=$user['local']?></li>
                  </ul>
                </section>
              </article>
            </a>
        <?php }
        } else { ?>
          <p>Não foi encontrado nenhum utilizador.</p>
        <?php } ?>
      </div>
