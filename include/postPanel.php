<div class="postPanel">
	<?php foreach($posts as $post){ ?>
	<h2><b><?php echo $post->title; ?><a href="<?php echo 'user.php?username='.$post->postby->username; ?>"><?php echo $post->postby->username; ?></a></b></h2>
	<p><?php echo nl2br($post->content); ?></p>
	<?php } ?>
</div>