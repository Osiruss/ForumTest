<div class="site-container">
<section>
	<table class="index forum--container">
		<thead>
			<tr>
				<th class="forum--title"></th>
				<th class="forum--stats forum--hide">Stats</th>
				<th class="forum--latest">Latest</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		for ($i=0; $i < count($forum_grouping); $i++) { ?>
			<tr class="forum--group-title">
				<th><?php echo $forum_grouping[$i]->title; ?></th>
			</tr>
		<?php for($l=0; $l < count($forum_grouping[$i]->forums); $l++) { 
			$forums = $forum_grouping[$i]->forums[$l];
			?>
			<tr>
				<td class="forum--title">
					<a href="<?php echo base_url('board/'.$forums->forum_id); ?>">
						<strong><?php echo $forums->title; ?></strong><br>
						<span><?php echo $forums->description; ?></span>
					</a>
				</td>
				<td class="forum--stats forum--hide">
					<?php echo $forums->thread_count; ?> <?php echo $forums->thread_count>1 || $forums->thread_count == 0 ? 'topics' : 'topic'; ?><br>
					<?php echo $forums->post_count; ?> <?php echo $forums->post_count>1 || $forums->post_count == 0 ? 'replies' : 'reply'; ?>
				</td>
				<td class="forum--latest">
					<?php if ($forums->latest === null) {
						echo 'None';
					} else { ?>
						<?php $page_num = $this->model_posts->get_page_num($forums->latest->post_id); ?>
						<?php $page_num = $page_num>1 ? '/'.$page_num : ''; ?>
						<a href='<?php echo base_url('thread/'.$forums->latest->thread_id.$page_num.'#'.$forums->latest->post_id); ?>'><?php echo $forums->latest->ago; ?> ago</a><br>By 
						<a href="<?php echo base_url('user').'/'.$forums->latest->user_id?>">
							<?php echo $forums->latest->username?>
						</a> 
					<?php } ?>
				</td>
			</tr>
		<?php	} ?>
			
	<?php	} ?>
		</tbody>
	</table>

	<section class='latest_activity'>
		<strong>Online in the last <?php echo $activity_limit; ?> minutes: <?php echo $latest_activity_count>1 || $latest_activity_count == 0 ? $latest_activity_count. ' users' : $latest_activity_count.' user';?></strong><br>
	
	<?php if ($latest_activity_count === 0) {
		echo '<p>No activity in the last '.$activity_limit.' minutes</p>';
	} else { ?>
	
	<?php for ($i=0; $i < $latest_activity_count; $i++) { ?>
		<a href="<?php echo base_url('user/'.$latest_activity[$i]->user_id); ?>">
			<?php echo $latest_activity[$i]->group_id == 1 ? '<strong>'.$latest_activity[$i]->username.'</strong>' : $latest_activity[$i]->username; ?></a> 
	<?php } 
	
	}?>
	</section>
</section>
</div>