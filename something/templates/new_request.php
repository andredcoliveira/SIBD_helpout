<div class="profile_wrapper">  
  <div class="profile">



    <div class="new_request">
      <h2>Novo Pedido</h2>

      <form action="actions/action_new_request.php" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Título para o pedido" required="required">
        <input type="text" name="location" placeholder="Localização" required="required">
        <input type="date" name="date">
        <input type="text" name="reward" placeholder="Recompensa">
        <textarea name="description" rows="4" cols="58">Insira aqui uma pequena decrição do seu pedido... </textarea>
        
        <label>Escolha uma imagem:
          <input type="file" name="fileToUpload" id="fileToUpload">
        </label>
        

        
        <input type="submit" value="Submeter" name="submit">
      </form>
    </div>
    


  </div>
</div>