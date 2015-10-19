<div class="site-container new">
<section>
	<h1>New thread</h1>
	<form action="" method="post">
		<label for="subject">Subject:</label>
		<input type="text" id='subject' name="subject" placeholder='Subject' value="<?php echo set_value('subject'); ?>">
		<label for="message">Message:</label>
		<textarea id="message" cols="30" name="message" rows="10" placeholder='Message'><?php echo set_value('message'); ?></textarea>
		<input type="submit">
		<?php echo validation_errors(); ?>
	</form>
</section></div>