<div class="site-container profile">
	<section>
		<h1><?php echo $user->username; ?>'s profile</h1>
		<figure>
			<img src="<?php echo base_url('img/thumb').'/'.$user->avatar?>" alt="Avatar" title="<?php echo $user->username?>'s avatar">
		</figure>
		<article>
			<p><?php echo $user->bio; ?></p>
		</article>
		<?php if ($this->is_admin || (isset($this->session->userdata()['id']) && $user->user_id == $this->session->userdata()['id'])) { ?>
			<a class="btn edit_profile" href="<?php echo base_url('user/edit').'/'.$user->user_id; ?>">Edit profile</a>
		<?php } ?>
	</section>
</div>