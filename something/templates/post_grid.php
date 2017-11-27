      <div class="post_grid">          <!-- ISTO PODE SER UM TEMPLATE -->
        <?php foreach($requests as $request) { ?>
            <a href="request.php?id=<?=$request['pedido_id']?>">
              <article class="post_request">
                <div class="post_img_wrapper" style="background-image: url('<?=$request_photo_paths[$k++]?>');"></div>
                <section class="post_description">
                  <h3><?=$request['name']?></h3>
                  <ul>
                    <li><?=$request['location']?></li>
                    <li><?=$request['date_limit']?></li>
                    <li>nr de pessoas (?)</li>
                  </ul>
                  <p>Por: <?=getRequestOwner($request['pedido_id'])['name'];?></p>
                </section>
              </article>
            </a>
        <?php } ?>
      </div>                          <!-- ATÉ AQUI  -->
