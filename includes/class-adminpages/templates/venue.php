<link href="//cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo mvc_css_url('yanni-gallery', 'my_style');?>" />
<h2>Venue list <a href="/wp-admin/post-new.php?post_type=venue" class="add-new-h2">Add Venue</a></h2>
<table class="tg">
	<thead>
		<tr>
			<th class="tg-031e">Featured image</th>
			<th class="tg-031e">Gallery title</th>
			<th class="tg-031e">Images count</th>
			<th class="tg-031e">Gallery description</th>
			<th class="tg-031e">Landing pages</th>
			<th class="tg-031e">Order</th>
			<th class="tg-031e">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($posts as $post) :
		
			preg_match('/\[gallery.*ids=\"(.*)\"\]/', $post->post_content, $preg);

			$img_count = count(explode(',', $preg[1]));
	
			?>
			<tr>
				<td class="tg-031e"><?=CUtil::thumbDiv($post->ID, 'medium', 100, 'img-admin-thumb')?></td>
				<td class="tg-031e"><?=$post->post_title?></td>
				<td class="tg-031e"><?=$img_count?></td>
				<td class="tg-031e"><?=CUtil::get_meta('description', $post->ID)?></td>
				<td class="tg-031e"><?=$img_count?></td>
				<td class="tg-031e"><?=$post->menu_order?></td>
				<td class="tg-031e">
					<a href="/wp-admin/post.php<?=wp_nonce_url( $bare_url, 'trash-post_'.$post->ID );?>&post=<?=$post->ID?>&action=edit">Edit</a> / 
					<a href="/wp-admin/post.php<?=wp_nonce_url( $bare_url, 'trash-post_'.$post->ID );?>&post=<?=$post->ID?>&action=trash" class="delete_btn">Delete</a>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>

<script type="text/javascript">
jQuery(document).ready(function() 
{
	jQuery('.tg').dataTable();
} );
</script>