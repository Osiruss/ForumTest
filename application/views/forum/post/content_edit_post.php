<div class="site-container edit">
<section>
	<h1>Edit post</h1>
		<form action="" method="post">
		<?php if ($first_post) {?>
			<input type="text" name="subject" id="subject" placeholder="Enter subject" value="<?php echo set_value('subject', $thread->subject); ?>">
		<?php } ?>
			<textarea id="message" cols="30" name="message" rows="10" placeholder='Message'><?php echo set_value('message', $post->message); ?></textarea>
			<input type="submit">
			<?php echo validation_errors(); ?>
		</form>
</section>
</div>