<div class="recent_comments">
  <h2>Comentários Recentes</h2>


  <?php for($i=0; $i<6; $i++) { ?>
    <article class="comment">

      <div class="stars">
        <h3>Titulo Comentário</h3>
        <?php for($j=0; $j<5; $j++) { ?>
          <img src="res/star.png">
        <?php } ?>
      </div>

      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque lacinia consectetur ligula, sed pharetra ipsum faucibus ut. Nunc dignissim finibus elit in imperdiet.</p>
      <p>Por: <a href="usr_profile.php">Daniel Granhão</a></p>
    </article>
  <?php } ?>
</div>