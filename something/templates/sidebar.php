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
        <?php if(getUserPhoto($_ID) !== false) { ?>
          <section class="user_photo">
            <img src="<?=getUserPhoto($_ID)?>" alt="User Photo">
          </section>
        <?php } ?>
        <section class="user_info">
          <h2><?=$_NAME?></h2>
          <ul>
            <li>A ajudar: <?=$helping_requests?></li>
            <li>A pedir ajuda: <?=$owned_requests?></li>
          </ul>
        </section>
      </aside>
