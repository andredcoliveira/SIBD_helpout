<div class="recent_comments">
  <h3>Comentários Recentes</h3>


  <?php foreach($comments as $comment) { ?>
    <article class="comment">

      <div class="stars">
        <h4><?php echo getRequest($comment['pedido_id'])['name']?></h4>
        <?php for($j = 0; $j < $comment['classification']; $j++) { ?>
          <img src="res/star.png">
        <?php } ?>
      </div>

      <p><?php echo $comment['comment']?></p>
      <p>&nbsp;-&nbsp;<a href="usr_profile.php?id=<?=$comment['commenter_id']?>"><?=$comment['name']?></a></p>
    </article>
  <?php } ?>
</div>
