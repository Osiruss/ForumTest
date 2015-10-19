<div class="site-container forum">
	<section>
		<form action="#" method="post" class="login__form">
			<label>Username:</label>
			<input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>" placeholder='Username'>
			<label>Password:</label>
			<input type="password" name="password" id="password" placeholder='Password'>
			<input type="submit" value="SUBMIT">
		</form>
		<?php
		echo validation_errors();

		echo $this->session->flashdata('error');

		echo !empty($resend) ? $resend : ''; ?>
	</section>
</div>