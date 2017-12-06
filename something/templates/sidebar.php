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
          </section>
          <section class="tools">
            <?php if(getCurrentPage()=='feed.php') { ?>
              <br><a href="#custom_feed" id="customize_feed">Personalizar Feed</a>
            <?php } ?>
            <form action="actions/action_search.php" method="post">
              <input type="hidden" name="referrer_page" value="<?=getCurrentPage()?>">
              <input type="text" name="search_box" placeholder="Pesquisa" size='15'>
              <input type="submit" style="display: none;">
            </form>
          </section>
        </div>
      </aside>
      <div id="custom_feed" class="overlay">
        <div class="popup">
          <a class="close" href="#/">×</a>
          <h2>Feed</h2>
          <form action="actions/action_filter_feed.php?" method="post" class="all_filters">
            <fieldset class="filters">
              <legend><strong>Filtros</strong></legend>
              <?php if($skills != false) { foreach($skills as $skill) { ?>
                <label><input type="checkbox" id="<?=$skill['id']?>" name="skills[]" value="<?=$skill['id']?>" <?php echo (userHasFilter($_ID, $skill['id'])? 'checked' : '')?>><?=$skill['nome']?></label>
              <?php } } ?>
              <div id=filter_type>
                <label><input type="radio" value="all" name="filter_type" checked>Todos</label>
                <label><input type="radio" value="any" name="filter_type">Qualquer</label>
              </div>
            </fieldset>
            <fieldset class="order">
              <legend><strong>Ordenar</strong></legend>
              <?php $id_array = array('name','reward', 'added_date', 'date_limit');
                $label_array = array('Nome', 'Recompensa', 'Data de adição', 'Data limite');
                for($i=0; $i<4; $i++) {?>
                <div id="<?=$id_array[$i]?>">
                  <label><input type="checkbox" value=<?=$id_array[$i]?> name="name[]"><?=$label_array[$i]?></label><br>
                  <label><input type="radio" value="asc" name="type[<?=$id_array[$i]?>]" checked>&darr;</label>
                  <label><input type="radio" value="desc" name="type[<?=$id_array[$i]?>]">&uarr;</label>
                </div>
              <?php } ?>
            </fieldset>
            <fieldset class="priority">
              <legend><strong>Prioridade</strong></legend>
              <?php $id_array = array('name','reward', 'added_date', 'date_limit');
                $label_array = array('Nome', 'Recompensa', 'Data de adição', 'Data limite');
                for($i=0; $i<4; $i++) { ?>
                <div id="<?=$id_array[$i]?>">
                  <label><select name="priority[<?=$id_array[$i]?>]">
                    <option <?php echo ($i+1)==1?"selected='selected'":"";?>>1</option>
                    <option <?php echo ($i+1)==2?"selected='selected'":"";?>>2</option>
                    <option <?php echo ($i+1)==3?"selected='selected'":"";?>>3</option>
                    <option <?php echo ($i+1)==4?"selected='selected'":"";?>>4</option>
                  </select><?=$label_array[$i]?></label>
                </div>
              <?php } ?>
            </fieldset>
            <input type="submit" value="Atualizar" name="submit">
          </form>
        </div>
      </div>
