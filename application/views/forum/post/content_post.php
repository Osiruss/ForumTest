<div class="site-container">
	<section>
	<h1><a href="<?php echo base_url('thread/'.$post->thread_id); ?>"><?php echo $subject; ?></a></h1>
		<table class="thread">
			<tbody>
				<tr class="table--post" id='<?php echo $post->post_id; ?>'>
					<td class="table__field--thread-author">
						<?php echo '<a href="'.base_url('user').'/'.$post->user_id.'">'.$post->username.'</a>'; ?>
						<figure>
							<a href="<?php echo base_url('user').'/'.$post->user_id; ?>">
							<img src="<?php echo base_url('img/thumb').'/'.$post->avatar?>" alt="Avatar" title="<?php echo $post->username?>'s avatar">
							</a><br>
							Joined: <?php echo date("jS F Y",strtotime($post->joined)); ?>
						</figure>

					</td>
					<td class="table__field--thread-message">
						<table>
							<tr class="table__field--meta"><td><?php echo date("jS F g:ia",strtotime($post->posted_on)); ?></td></tr>
							<tr class="table__field"><td><?php echo nl2br($post->message); ?></td></tr>
							<?php if (isset($this->session->userdata()['id']) && $post->user_id == $this->session->userdata()['id']) { ?>	
							<tr class="table__field--edit">
								<td>
									<a class="btn btn-edit" href="<?php echo base_url('post/edit').'/'.$post->post_id; ?>">
										Edit
									</a>
								</td>
							</tr>
							<?php } ?>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	</section>
</div>