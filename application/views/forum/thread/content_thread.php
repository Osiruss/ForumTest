<div class="site-container">
	<section>
		<h1><?php echo $subject; ?></h1>
		<?php 
		echo $breadcrumbs;
		echo $pagination;
		 ?>
		<div class="btn-new">
			<a class="btn" href="<?php echo base_url('post/new/').'/'.$tid ?>">New post</a>
		</div>

		<table class="thread">
			<tbody>
				<?php for ($i=0; $i < count($posts); $i++) { ?>
				<tr class="table--post" id='<?php echo $posts[$i]->post_id; ?>'>
					<td class="table__field--thread-author">
						<?php echo '<a href="'.base_url('user').'/'.$posts[$i]->user_id.'">'.$posts[$i]->username.'</a>'; ?>
						<figure>
							<a href="<?php echo base_url('user').'/'.$posts[$i]->user_id; ?>">
							<img src="<?php echo base_url('img/thumb').'/'.$posts[$i]->avatar?>" alt="Avatar" title="<?php echo $posts[$i]->username?>'s avatar">
							</a><br>
							Joined: <?php echo date("jS F Y",strtotime($posts[$i]->joined)); ?>
						</figure>

					</td>
					<td class="table__field--thread-message">
						<table>
							<tr class="table__field--meta">
								<td><a href="<?php echo base_url('post/'.$posts[$i]->post_id); ?>"><?php echo date("jS F g:ia",strtotime($posts[$i]->posted_on)); ?></a></td>
								<td class="table__field--permalink table__field--hide"><a href="<?php echo base_url('post/'.$posts[$i]->post_id); ?>">Permalink</a></td>
							</tr>
							<tr class="table__field"><td><?php echo nl2br($posts[$i]->message); ?></td></tr>
						</table>
						<tr class="table__field--edit">
							<td>
					<?php if ($this->model_users->loggedin() &&
					 ($posts[$i]->user_id == $this->session->userdata('id') || $this->model_users->is_admin())) { ?>	
								<a class="btn" href="<?php echo base_url('post/edit').'/'.$posts[$i]->post_id; ?>">
									Edit
								</a>
								<a class="btn" href="<?php echo base_url('post/delete').'/'.$posts[$i]->post_id; ?>">
									Delete
								</a>
					<?php } ?>
							</td>
						</tr>				
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php echo $pagination; ?>
	</section>
	<section>
		<form id='quick_reply' action="#quick_reply" method="post">
			<textarea name="message" id="message" cols="30" rows="10" placeholder='Write your message..'></textarea>
			<input type="submit" value="Quick reply">
		</form>
		<?php echo validation_errors(); ?>
		<?php echo $this->session->flashdata('error'); ?>
	</section>
</div>