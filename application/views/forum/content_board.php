<div class="site-container">
	<section>
		<?php echo $breadcrumbs; ?>
		<?php echo $pagination; ?>
		<div class="btn-new">
			<a class="btn" href="<?php echo base_url('thread/new').'/'.$fid ?>">Create thread</a>
		</div>
		<table class="board forum--container">
			<thead>
				<tr>
					<th class="forum--title">Thread</th>
					<th class="forum--author forum--hide">Author</th>
					<th class="forum--stats forum--hide">Stats</th>
					<th class="forum--latest">Latest</th>
				</tr>
			</thead>
			<tbody>
				<?php
				 if (count($threads) == 0) {
					echo '<tr><td class="forum--empty">There are currently no threads in this forum.</td></tr>';
				}
				 for ($i=0; $i < count($threads); $i++) { ?>
				<tr>
					<td class="forum--title">
						<a href="<?php echo base_url('thread/'.$threads[$i]->thread_id); ?>">
						<?php echo $threads[$i]->subject; ?>
						</a>
					</td>
					<td class="forum--hide forum--author"><a href='<?php echo base_url('user').'/'.$threads[$i]->user_id; ?>'><?php echo $threads[$i]->username; ?></a></td>
					<td class="forum--hide forum--stats"><?php echo $threads[$i]->post_count; ?> <?php echo $threads[$i]->post_count>1 ? 'replies' : 'reply'; ?></td>
					<td class="forum--latest">
					<?php $page_num = $this->model_posts->get_page_num($threads[$i]->latest->post_id); ?>
					<?php $page_num = $page_num>1 ? '/'.$page_num : ''; ?>
						<a href='<?php echo base_url('thread/'.$threads[$i]->thread_id.$page_num.'#'.$threads[$i]->latest->post_id); ?>'><?php echo $threads[$i]->latest->ago; ?> ago</a><br>By 
						<a href="<?php echo base_url('user').'/'.$threads[$i]->latest->user_id?>">
							<?php echo $threads[$i]->latest->username?>
						</a> 
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php echo $pagination; ?>
	</section>
</div>