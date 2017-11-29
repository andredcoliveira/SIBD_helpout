      <?php /* get request numbers */
        if( getHelpingRequests($_ID, 0) === false ) {
          $helping_requests = 0;
        } else {
          $helping_requests = count(getHelpingRequests($_ID, 0));
        }
        if( getOwnedRequests($_ID, 0) === false ) {
          $owned_requests = 0;
        } else {
          $owned_requests = count(getOwnedRequests($_ID, 0));
        }
      ?>
      <a href="#show_sidebar" class="sidebar_colapsed">
        <span><strong>SHOW SIDEBAR</strong></span>
      </a>
      <aside id="show_sidebar" class="sidebar">
        <a href="#/" class="close_sidebar">close</a>
        <div class='sidebar_wrapper'>
          <?php if(getUserPhoto($_ID) !== false) { ?>
            <section class="user_photo">
              <img src="<?=getUserPhoto($_ID)?>" alt="User Photo">
            </section>
          <?php } ?>
          <section class="user_info">
            <h2><?=$_NAME?></h2>
            <ul>
              <li><a href='my_requests.php?h=1#show_sidebar'>A ajudar: <?=$helping_requests?></a></li>
              <li><a href='my_requests.php?h=0#show_sidebar'>A pedir ajuda: <?=$owned_requests?></a></li>
            </ul>
            <?php if(getCurrentPage()=='feed.php') { ?>
            <h4>Ignorar</h4>
            <form action="actions/action_filter_feed.php?" method="post" class="filters">
              <?php if($skills != false) { foreach($skills as $skill) { ?>
                <label><input type="checkbox" id="<?=$skill['id']?>" name="skills[]" value="<?=$skill['id']?>" <?php echo (userHasFilter($_ID, $skill['id'])? 'checked' : '')?>><?=$skill['nome']?></label>
              <?php } } ?>
              <input type="submit" value="Atualizar" name="submit">
            </form>
            <?php } ?>
          </section>
        </div>
      </aside>
