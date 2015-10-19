<div class="site-container profile">
	<section>
		<h1>Edit <?php echo $user->username; ?>'s profile</h1>
		<form action="" method="post" enctype="multipart/form-data">
			<label for="avatar">Avatar:</label>
			<input type="file" name="avatar" id="avatar">
			<label for="bio">Bio:</label>
			<textarea name="bio" id="bio" cols="30" rows="10"><?php echo set_value('bio', $user->bio); ?></textarea>
			<input type="submit" value="Submit changes">
		 	<?php echo validation_errors(); ?>
		 	<?php echo !empty($error) ? $error : ''; ?>
		</form>
	</section>
</div>