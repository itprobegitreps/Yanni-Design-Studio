<link href="//cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo mvc_css_url('yanni-gallery', 'my_style');?>" />
<h2>Images list <a href="/wp-admin/media-new.php" class="add-new-h2">Add image</a></h2>
<table class="tg">
	<thead>
		<tr>
			<th class="tg-031e">Image</th>
			<th class="tg-031e">Image Title</th>
			<th class="tg-031e">Image Description</th>
			<th class="tg-031e">Image Venue</th>
			<th class="tg-031e">Actions</th>			
		</tr>
	</thead>
	<tbody>
		<?php 

		foreach ($posts as $post) :
		
			$venue_id = get_post_meta($post->ID, '_venue', true);
			?>
			<tr>
				<td class="tg-031e"><div style="background: url(<?=wp_get_attachment_thumb_url( $post->ID )?>) no-repeat center; background-size:cover; width:130px; margin: 0 auto; height:130px;"></div></td>
				<td class="tg-031e"><?=$post->post_title?></td>
				<td class="tg-031e"><?=$post->post_content?></td>
				<td class="tg-031e"><?=$out_options[$venue_id]?></td>
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