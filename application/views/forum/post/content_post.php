<div class="site-container">
	<section>
	<h1><a href="<?php echo base_url('thread/'.$post->thread_id); ?>"><?php echo $subject; ?></a></h1>
		<table class="thread">
			<tbody>
				<tr class="post" id='<?php echo $post->post_id; ?>'>
					<td class="post--author">
						<?php echo '<a href="'.base_url('user').'/'.$post->user_id.'">'.$post->username.'</a>'; ?>
						<figure>
							<a href="<?php echo base_url('user').'/'.$post->user_id; ?>">
							<img src="<?php echo base_url('img/thumb').'/'.$post->avatar?>" alt="Avatar" title="<?php echo $post->username?>'s avatar">
							</a><br>
							Joined: <?php echo date("jS F Y",strtotime($post->joined)); ?>
						</figure>

					</td>
					<td class="post--message">
						<table>
							<tr class="post--meta"><td><?php echo date("jS F g:ia",strtotime($post->posted_on)); ?></td></tr>
							<tr><td><?php echo nl2br($post->message); ?></td></tr>
						</table>
						<tr class="post--edit">
							<td>
						<?php if (isset($this->session->userdata()['id']) && $post->user_id == $this->session->userdata()['id']) { ?>	
								<a class="btn btn-edit" href="<?php echo base_url('post/edit').'/'.$post->post_id; ?>">
									Edit
								</a>
						<?php } ?>
							</td>
						</tr>
					</td>
				</tr>
			</tbody>
		</table>
	</section>
</div>