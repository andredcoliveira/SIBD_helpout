<nav class="requests_nav">
  <ul>
    <li><a href="my_requests.php">A ajudar</a></li>
    <li><a href="my_requests.php">A pedir ajuda</a></li>
  </ul>
</nav>
<div class="post_grid">
  <?php for($i=0; $i<20; $i++) { ?>
    <a href="index2.php">
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
</div>