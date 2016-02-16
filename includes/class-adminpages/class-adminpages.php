<?php
/*
* Class represents custom admin pages
*/

class CAdminPages {

	static function Venue()
	{
		$posts = get_posts(array('post_type' => 'venue', 'posts_per_page' => -1));

		include(__DIR__ . '/templates/venue.php');
	}

	static function Recent()
	{
		$posts = get_posts(array('post_type' => 'recent', 'posts_per_page' => -1));

		include(__DIR__ . '/templates/recent.php');
	}

	static function Design()
	{
		$posts = get_posts(array('post_type' => 'design', 'posts_per_page' => -1));

		include(__DIR__ . '/templates/design.php');
	}

	static function Video()
	{
		$posts = get_posts(array('post_type' => 'video', 'posts_per_page' => -1));

		include(__DIR__ . '/templates/video.php');
	}

	static function Images()
	{
		global $wpdb;

		$posts = get_posts(array('post_type' => 'attachment', 'posts_per_page' => -1));
		$options  = $wpdb->get_results('SELECT id, name FROM ' . $wpdb->prefix . 'venues ORDER BY name ASC', ARRAY_A);

		$out_options = Array();

		foreach($options as $option)
		{
		    $out_options[$option['id']] = $option['name'];
		}
		
		include(__DIR__ . '/templates/images.php');
	}
}


?>