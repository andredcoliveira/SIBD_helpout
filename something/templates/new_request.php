<div class="profile_wrapper">  
  <div class="profile">



    <div class="new_request">
      <h2>Novo Pedido</h2>

      <form action="actions/new_request.php" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Título para o pedido" required="required">
        <input type="text" name="location" placeholder="Localização" required="required">
        <input type="date" name="date">
        <input type="text" name="reward" placeholder="Recompensa">
        <textarea rows="4" cols="50">Insira aqui uma pequena decrição do seu pedido... </textarea>
        
        <input type="file" name="image">

        <input type="submit" value="Submeter">
      </form>
    </div>
    


  </div>
</div>