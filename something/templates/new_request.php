<div class="profile_wrapper">  
  <div class="profile">




    <h2>Novo Pedido</h2>

    <form action="actions/new_request.php" method="post" enctype="multipart/form-data">
      <input type="text" name="title" placeholder="Título para o pedido" required="required">
      <input type="text" name="location" placeholder="Localização" required="required">
      <input type="date" name="date">
      <input type="text" name="reward" placeholder="Recompensa">
      <textarea></textarea>
      <input type="submit" value="Submeter">
      <input type="file" name="image">
    </form>

    <div class="request">
      <div class="request_left">
        <h2>Título do pedido</h2>
        <div class="request_pic_wrapper" style="background-image: url('res/estudar.jpg');"></div>
        <div class="description_wrapper">
          <h2>Descrição</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque lacinia consectetur ligula, sed pharetra ipsum faucibus ut. Nunc dignissim finibus elit in imperdiet. Vivamus eu scelerisque enim. Vestibulum a fermentum nunc. Duis id dui et mauris finibus sagittis in sit amet felis. Nulla dictum dui justo, vel varius ligula euismod sed. Suspendisse pellentesque consectetur rutrum. Proin fringilla enim enim, vitae aliquam neque efficitur et. Morbi sed dignissim elit, quis porttitor tortor. Praesent dapibus scelerisque luctus. Etiam et dolor mauris. Fusce bibendum sed purus et tincidunt. Proin metus massa, viverra nec pulvinar sit amet, venenatis id diam. Cras pulvinar vel ipsum eget elementum. Donec sed consectetur leo, id dictum turpis. Vivamus nec risus non enim hendrerit consectetur a sed tortor.</p>
        </div>
      </div>
      <div class="request_right">
        <div class="request_fields">
          <h3>Acerca deste pedido:</h3>
          <ul>
            <li>Recompensa</li>
            <li>Quando</li>
            <li>Onde</li>
          </ul>
        </div>

        <a href="./usr_profile.php" class="usr_profile_link">
          <div class="request_usr_profile">
            <h3>Pedido feito por:</h3>
            <div class="profile_pic_wrapper" style="background-image: url('res/pessoa.jpg');"></div>
            <div class ="profile_top_right">
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
        </a>

      </div>
    </div>


  </div>
</div>