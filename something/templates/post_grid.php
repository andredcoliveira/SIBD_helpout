
      <?php if($requests != false && $requests != -1) { ?>
        <div class="post_grid">
          <?php foreach($requests as $key => $request) { ?>
            <a href="request.php?id=<?=$request['id']?>">
              <article class="post_request">
                <?php if($request_photo_paths[$key] !== false) { ?>
                  <img class="post_img_wrapper" src="<?=$request_photo_paths[$key]?>">
                <?php } else {?>
                  <img class="post_img_wrapper" src="res/default_request.png">
                <?php }?>
                <section class="post_description">
                  <h3><?=$request['name']?></h3>
                  <ul>
                    <li><?=$request['location']?></li>
                    <li><?=$request['date_limit']?></li>
                  </ul>
                  <p>Por: <?=getRequestOwner($request['id'])['name'];?></p>
                </section>
              </article>
            </a>
          <?php } ?>
        </div>
      <?php } else { ?>
        <span class="notfound">Não foi encontrado nenhum pedido ativo.</span>
      <?php } ?>
