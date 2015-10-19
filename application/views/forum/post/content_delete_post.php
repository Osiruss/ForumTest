<div class="site-container delete">
<section>
	<h1>Are you sure you want to delete this <?php echo $is_first ? 'thread' : 'post'; ?>?</h1>
		<form action="" method="post">
			<input type="submit" value="Yes"> <a href="<?php echo base_url('thread/'.$tid) ?>" class="btn">No</a>
			<input type="hidden" name="delete" value="1">
		</form>	
</section>
</div>