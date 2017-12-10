<?php if(($owner_id == $_ID) && !getComment($participant['id'], $request_id)) { ?>
  <form action="actions/action_insert_comment.php" method="post" class="comment_form">
    <div class="comment_form_top">
      <label for="comment">Comentar participante</label>
      <?php include('templates/star_rating.php'); ?>
    </div>
    <textarea cols="40" rows="2" name="comment" ></textarea>
    <input type="hidden" name="user_id" value="<?=$participant['id']?>">
    <input type="hidden" name="request_id" value="<?=$request_id;?>">
    <input type="submit" value="Submeter" name="submit">
  </form>
<?php } else if($comment = getComment($participant['id'], $request_id)) {?>
  <div class="comment_request_page">
    <div class="comment_request_page_stars">
      <p>
        <?php for($i=0 ; $i<$comment['classification'] ; $i++) { ?>
          ★
        <?php } ?>
      </p>
    </div>
    <p><?=$comment['comment']?></p>
  </div>
<?php } else if(!getComment($participant['id'], $request_id)) { ?>
  <div class="comment_request_page">
    <p>De momento sem avaliação</p>
  </div>
<?php } ?>