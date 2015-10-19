<div class="site-container">
	<section>
	<?php if ($this->session->flashdata('message')) {
		echo $this->session->flashdata('message');
	} else { ?>
		<form action="" method="post" class="register__form" name="register">
			<label>Username:</label>
			<input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>" placeholder='Username'>
			<label>Password:</label>
			<input type="password" name="password" id="password" placeholder='Password'>
			<label>Confirm password:</label>
			<input type="password" name="password2" id="password2" placeholder='Confirm password'>
			<label>Email:</label>
			<input type="text" name="email" id="email" placeholder='Email' value="<?php echo set_value('email'); ?>">
			<input type="submit" value="SUBMIT">
			<section class="validation error">
				<?php echo validation_errors(); ?>
			</section>
		</form>
		<?php } ?>
		<?php echo isset($error) ? $error : ''; ?>
	</section>
</div>