<div class="site-container confirmation">
	<section>

	<?php if ($activated) { ?>
		<h1>Your account has been activated</h1>
		<p>Please <a href="<?php echo base_url('site/login'); ?>">login</a></p>
	<?php } 
	echo $this->session->flashdata('error');
	?>

	</section>
</div>