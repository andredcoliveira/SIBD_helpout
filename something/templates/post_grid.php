      <div class="post_grid">
        <?php if($requests != false && $requests != -1) {
          foreach($requests as $key => $request) { ?>
            <a href="request.php?id=<?=$request['id']?>">
              <article class="post_request">
                <?php if($request_photo_paths[$key] !== false) { ?>
                  <div class="post_img_wrapper" style="background-image: url('<?=$request_photo_paths[$key]?>');"></div>
                <?php } else {?>
                  <div class="post_img_wrapper" style="background-image: url('res/default_request.png');"></div>
                <?php }?>
                <section class="post_description">
                  <h3><?=$request['name']?></h3>
                  <ul>
                    <li><?=$request['location']?></li>
                    <li><?=$request['date_limit']?></li>
                    <li>nr de pessoas (?)</li>
                  </ul>
                  <p>Por: <?=getRequestOwner($request['id'])['name'];?></p>
                </section>
              </article>
            </a>
        <?php }
        } else { ?>
          <p>Não foi encontrado nenhum pedido ativo.</p>
        <?php } ?>
      </div>
