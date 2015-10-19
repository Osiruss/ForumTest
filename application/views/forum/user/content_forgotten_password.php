<div class="site-container forgotten-password">
	<section>
		<h1>Enter email</h1>
		<form action="" method="post">
			<input type="text" name="email" id="email">
			<input type="submit" value="Submit changes">
		 	<?php echo validation_errors(); ?>
		 	<?php echo !empty($error) ? $error : ''; ?>
		</form>
	</section>
</div>