<div class="profile_wrapper">  
  <div class="profile">
    <div class="profile_top">
      <div class="profile_pic_wrapper" style="background-image: url('res/pessoa.jpg');"></div>
      <div class="profile_top_right">
        <h2>Nome</h2>
        <div class="stars">
          <img src="res/star.png">
          <h3>4.3</h3>
        </div>
        <ul>
          <li>Profissão</li>
          <li>Localidade</li>
          <li>Qualquer coisa mais</li>
        </ul>
      </div>
    </div>
    <div class="description_wrapper">
      <h2>Descrição</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque lacinia consectetur ligula, sed pharetra ipsum faucibus ut. Nunc dignissim finibus elit in imperdiet. Vivamus eu scelerisque enim. Vestibulum a fermentum nunc. Duis id dui et mauris finibus sagittis in sit amet felis. Nulla dictum dui justo, vel varius ligula euismod sed. Suspendisse pellentesque consectetur rutrum. Proin fringilla enim enim, vitae aliquam neque efficitur et. Morbi sed dignissim elit, quis porttitor tortor. Praesent dapibus scelerisque luctus. Etiam et dolor mauris. Fusce bibendum sed purus et tincidunt. Proin metus massa, viverra nec pulvinar sit amet, venenatis id diam. Cras pulvinar vel ipsum eget elementum. Donec sed consectetur leo, id dictum turpis. Vivamus nec risus non enim hendrerit consectetur a sed tortor.</p>
    </div>

    <div class="recent_posts">
      <h2>Pedidos Recentes</h2>
      <div class="post_grid">          <!-- ISTO PODE SER UM TEMPLATE -->
        <?php for($i=0; $i<6; $i++) { ?>    
            <a href="request.php">
              <article class="post_request">
                <div class="post_img_wrapper" style="background-image: url('./res/estudar.jpg');"></div>
                <section class="post_description">
                  <h3>Preciso de ajuda a estudar!</h3>
                  <ul>
                    <li>Gondomar</li>
                    <li>20/11/2017</li>
                    <li>1 Pessoa</li>
                  </ul>
                  <p>Por: Daniel Granhão</p>
                </section>
              </article>
            </a>
          <?php } ?>
      </div>                          <!-- ATÉ AQUI  -->
    </div>

    <?php include('templates/comments.php'); ?>



  </div>
</div>