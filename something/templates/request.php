<div class="profile_wrapper">
  <div class="profile">

    <div class="request">
      <div class="request_left">
        <?php if(getRequestPhoto($request_id) != false) { ?>
          <img class="request_pic_wrapper" src="<?=getRequestPhoto($request_id)?>">
        <?php } else { ?>
          <img class="request_pic_wrapper" src="res/default_request.png">
        <?php } ?>
        <h3><?=$request['name']?></h3>
        <div class="description_wrapper">
          <h4>Descrição</h4>
          <p><?=$request['description']?></p>
        </div>
      </div>
      <div class="request_right">
        <div class="request_fields">
          <h4>Sobre</h4>
          <ul>
            <li><?=$request['reward']?></li>
            <li><?=$request['date_limit']?></li>
            <li><?=$request['location']?></li>
          </ul>
        </div>

        <a href="./usr_profile.php?id=<?=$owner_id?>" class="usr_profile_link">
          <div class="request_usr_profile">
            <h4>Feito por</h4>
            <?php if(getUserPhoto($owner_id) != false) { ?>
              <div class="profile_pic_wrapper" style="background-image: url('<?=getUserPhoto($owner_id)?>');"></div>
            <?php } else { ?>
              <div class="profile_pic_wrapper" style="background-image: url('res/avatar.png');"></div>
            <?php } ?>
            <div class ="profile_top_right">
              <h2><?=$request_owner['name']?></h2>
            <div class="stars">
              <img src="res/star.png">
              <?php if(($score=getScore($owner_id)) != -1) { ?>
                <span>&nbsp;&nbsp;<?=$score?></span>
              <?php } else { ?>
                <span class="no_score">&nbsp;&nbsp;Sem classificação.</span>
              <?php } ?>
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
      <h4>Participantes</h4>
      <div class="participants_wrapper">

        <?php foreach($participants as $participant){ ?>
          <article class="participant">
            <div class="participant_pic_wrapper" style="background-image: url(<?=getUserPhoto($participant['id'])?>);"></div>
            <h4><a href="usr_profile.php?id=<?=$participant['id']?>"><?=$participant['name']?></a></h4>


              <?php if($request['active'] === false) include('templates/request_comments.php'); ?>

          </article>
        <?php }
        if($participants == NULL){ ?>
          <article class="no_participant">
            <span>De momento ninguém se encontra a ajudar...</span>
          </article>
        <?php } ?>

      </div>
    </div>

    <div class="options">
      <?php if($request_owner['id'] == $_ID && getRequest($request_id)['active']) {?>
        <h5 id="finish_request"><a href="actions/action_finish_request.php?id=<?=$request_id?>">Terminar Pedido</a></h5>
      <?php } ?>

      <?php if(getRequest($request_id)['active'] == false){ ?>
        <h5 style="color:red;">Pedido terminado!</h5>
      <?php } else {?>
        <h5 style="color:green;">Pedido a decorrer!</h5>
      <?php }?>

      <?php if($request_owner['id'] != $_ID && getRequest($request_id)['active'] && !isHelping($request_id, $_ID)) {?>
        <h5 id="help_request"><a href="actions/action_help_request.php?id=<?=$request_id?>">Ajudar!</a></h5>
      <?php } ?>
      <?php if($request_owner['id'] != $_ID && getRequest($request_id)['active'] && isHelping($request_id, $_ID)) {?>
        <h5 id="stop_help_request"><a href="actions/action_stop_help_request.php?id=<?=$request_id?>">Deixar de Ajudar!</a></h5>
      <?php } ?>
      <?php if($request_owner['id'] == $_ID || isHelping($request_id, $_ID)) { ?>
        <h5 id="chat_link"><a href="chat.php?id=<?php echo getChatIdByRequestId($request_id)['id'];?>">Chat</a></h5>
      <?php } ?>
    </div>


  </div>
</div>
