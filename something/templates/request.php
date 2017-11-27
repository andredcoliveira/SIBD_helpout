<div class="profile_wrapper">
  <div class="profile">

    <div class="request">
      <div class="request_left">
        <h2><?=$request['name']?></h2>
        <div class="request_pic_wrapper" style="background-image: url('res/uploads/requests/<?=$request_id?>.jpg');"></div>
        <div class="description_wrapper">
          <h2>Descrição</h2>
          <p><?=$request['description']?></p>
        </div>
      </div>
      <div class="request_right">
        <div class="request_fields">
          <h3>Acerca deste pedido:</h3>
          <ul>
            <li><?=$request['reward']?></li>
            <li><?=$request['date_limit']?></li>
            <li><?=$request['location']?></li>
          </ul>
        </div>

        <a href="./usr_profile.php?id=<?=$owner_id?>" class="usr_profile_link">
          <div class="request_usr_profile">
            <h3>Pedido feito por:</h3>
            <div class="profile_pic_wrapper" style="background-image: url('res/uploads/users/<?=$owner_id?>.jpg');"></div>
            <div class ="profile_top_right">
              <h2><?=$request_owner['name']?></h2>
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

    <div class="participants">
      <h3>Quem se encontra a ajudar:</h3>
      <div class="participants_wrapper">
        <article class="participant">
          <div class="participant_pic_wrapper" style="background-image: url('res/pessoa.jpg');"></div>
          <h4><a href="usr_profile.php">José Faria</a></h4>
        </article>
        <article class="participant">
          <div class="participant_pic_wrapper" style="background-image: url('res/pessoa.jpg');"></div>
          <h4><a href="usr_profile.php">José Faria</a></h4>
        </article>
        <article class="participant">
          <div class="participant_pic_wrapper" style="background-image: url('res/pessoa.jpg');"></div>
          <h4><a href="usr_profile.php">José Faria</a></h4>
        </article>
      </div>
    </div>

  </div>
</div>
