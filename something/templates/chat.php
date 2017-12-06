<div class="profile_wrapper">
  <div class="profile">

    <div class="chat">
    	<div class="chat_header">
    		<h3>Chat do pedido: <a href="request.php?id=<?=$request['id']?>"><?=$request['name']?></a></h3>
    		<h4>Pedido por: <a href="usr_profile.php?id=<?=$owner['id']?>"><?=$owner['name']?></a></h4>
    	</div>
    	<div class="chat_new_message">
    		<form action="actions/action_new_message.php" method="post">
    			<input type="text" name="message" placeholder="Insira aqui uma nova mensagem..." size="33">
    			<input type="hidden" name="chat_id" value="<?=$chat_id?>">
    			<input type="submit" value="Enviar" name="submit">
    		</form>
    	</div>
    	<div class="messages_wrapper">

    		<?php foreach($messages as $message) {?>
    			<div <?php echo ($_ID == $message['user_id'])?'class="message_sent"':'class="message_received"'?>>
	    			<p><?=$message['message']?></p>
	    			<p>De: <a href="usr_profile.php?id=<?=$message['user_id']?>"><?=$message['user_name']?></a></p>
    			</div>
    		<?php } ?>
    	</div>
    </div>


  </div>
</div>
