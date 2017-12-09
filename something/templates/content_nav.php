<nav class="content_navigation">
	<ul>

		<?php for($i = 1; $i<= $numberOfPages ; $i++) { ?>
			<li><a href="feed.php?page=<?=$i?>" <?php echo ($i==$page)? 'class="active"':'';?>><?=$i?></a></li>
		<?php } ?>
	</ul>
</nav>
