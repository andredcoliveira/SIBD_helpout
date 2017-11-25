<?php include('config/init.php'); ?>
<?php include('templates/header.php'); ?>
<?php include('templates/sidebar.php'); ?>

      <div class="post_grid">
        <?php for($i=0; $i<20; $i++) { ?>
          <a href="index2.php">
            <article class="post_request">
              <section class="post_img">
                <img src="estudar.jpg" alt="Request Photo">
              </section>
              <section class="post_description">
                <h3>Preciso de ajuda a estudar!</h3>
                <ul>
                  <li>Gondomar</li>
                  <li>20/11/2017</li>
                  <li>1 Pessoa</li>
                </ul>
              </section>
            </article>
          </a>
        <?php } ?>
      </div>

<?php include('templates/content_nav.php'); ?>
<?php include('templates/footer.php'); ?>
