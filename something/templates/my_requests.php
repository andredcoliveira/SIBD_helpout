<nav class="requests_nav">
  <ul>
    <?php if($helping == 1) { ?>
      <li><a href="my_requests.php?h=1" class="active">A ajudar</a></li>
      <li><a href="my_requests.php?h=0">A pedir ajuda</a></li>
    <?php } elseif($helping == 0) { ?>
      <li><a href="my_requests.php?h=1">A ajudar</a></li>
      <li><a href="my_requests.php?h=0" class="active">A pedir ajuda</a></li>
    <?php } ?>
  </ul>
</nav>
<?php include('templates/post_grid.php'); ?>
