<div class="site-container">
	<section>
		<?php echo $breadcrumbs; ?>
		<?php echo $pagination; ?>
		<div class="btn-new">
			<a class="btn" href="<?php echo base_url('thread/new').'/'.$fid ?>">Create thread</a>
		</div>
		<table class="forum">
			<thead>
				<tr>
					<th class="table__field--title">Thread</th>
					<th class="table__field--author table__field--hide">Author</th>
					<th class="table__field--stats table__field--hide">Stats</th>
					<th class="table__field--latest">Latest</th>
				</tr>
			</thead>
			<tbody>
				<?php
				 if (count($threads) == 0) {
					echo '<tr><td class="table__field--empty">There are currently no threads in this forum.</td></tr>';
				}
				 for ($i=0; $i < count($threads); $i++) { ?>
				<tr>
					<td class="table__field--title">
						<a href="<?php echo base_url('thread/'.$threads[$i]->thread_id); ?>">
						<?php echo $threads[$i]->subject; ?>
						</a>
					</td>
					<td class="table__field--hide table__field--author"><a href='<?php echo base_url('user').'/'.$threads[$i]->user_id; ?>'><?php echo $threads[$i]->username; ?></a></td>
					<td class="table__field--hide table__field--stats"><?php echo $threads[$i]->post_count; ?> <?php echo $threads[$i]->post_count>1 ? 'replies' : 'reply'; ?></td>
					<td class="table__field--latest">
					<?php $page_num = $this->model_posts->get_page_num($threads[$i]->latest->post_id); ?>
					<?php $page_num = $page_num>1 ? '/'.$page_num : ''; ?>
						<a href='<?php echo base_url('thread/'.$threads[$i]->thread_id.$page_num.'#'.$threads[$i]->latest->post_id); ?>'><?php echo date("jS M g:ia",strtotime($threads[$i]->latest->posted_on)); ?></a><br>By 
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