<?php

/**
* Util class
*/


global $wpdb;

$venuesResource  = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'venues ORDER BY name ASC', ARRAY_A);

$venueData = Array();

foreach($venuesResource as $venue)
{
    $venueData[$venue['id']] = $venue;
}

class CUtil
{
	public static $callbacks = Array();

	/**
	 * Return first meta value
	 * 
	 * @param  string $meta_code
	 * @param  int $ID
	 * @return mixed
	 */
	static function get_meta($meta_code, $ID = '')
	{
		global $post;

		return array_shift(get_post_meta(is_numeric($ID) ? $ID : $post->ID,  $meta_code));
	}	

	/**
	 * Renders social icons
	 * @param  string  $url     
	 * @param  string  $text    
	 * @param  string  $img_url 
	 * @param  boolean $no_pin  
	 */
	static function getSocials($url, $text, $img_url = '', $no_pin = false)
	{?>
		<a data-toggle="tooltip" data-placement="top" data-original-title="Share on Facebook" href="http://www.facebook.com/sharer/sharer.php?u=<?=$url?>" target="_blank" class="social-icons__icon social-icons__icon--normal social-icons__icon--facebook"></a>
        <? if(!$no_pin):?><a data-toggle="tooltip" data-placement="top" data-original-title="Share on Pinterest" href="https://www.pinterest.com/pin/create/button/?url=<?=$url?>&media=<?=$img_url?>&description=<?=$text?>" target="_blank" class="social-icons__icon social-icons__icon--normal social-icons__icon--pinterest"></a>         
        	<? endif?>
        <a data-toggle="tooltip" data-placement="top" data-original-title="Share on Twitter" href="https://twitter.com/intent/tweet?text=<?=$url?> <?=$text?>" target="_blank" class="social-icons__icon social-icons__icon--normal social-icons__icon--twitter"></a> 
	<?}

	/**
	 * Returns venue location
	 * @param  int $venueId 
	 * @return string
	 */
	static function getVenueLocation($venueId)
	{
		if($venueId == 0) return '';
		global $wpdb;

		$venue = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'venues WHERE id = ' . $venueId, ARRAY_A);

		return (is_array($venue) ? $venue['name'] : '');
	}

	/**
	 * Shows image
	 */
	static function shareImage()
	{
		$im = self::getImageRequest();		
		
		header('Content-type: image/png');
	   	readfile($im['src']);
		exit;
	}

	/**
	 * Custom image request
	 * @return array
	 */
	static function getImageRequest()
	{
		$path_parts = explode("/",$_SERVER['REQUEST_URI']);	

		if(intval($path_parts[3]) == 0) return;

		$image = get_post($path_parts[3]);
		
		if($image->post_type !='attachment') return;

		$path_parts = pathinfo($image->guid);
		$img_name = basename($image->guid);

		$file = ABSPATH . $image->guid;

		if(!file_exists($file))
		{
			$file = ABSPATH . preg_replace("/http:\/\/.*?\//i", "", $image->guid);
		}

		return array('src' =>$file, 'name' => $img_name);
	}

	static function getOptimizedImage($attachId)
	{
		$image = get_post($attachId);
		
		if($image->post_type !='attachment') return;

		$path_parts = pathinfo($image->guid);
		$img_name = basename($image->guid);

		$file = ABSPATH . $image->guid;

		if(!file_exists($file))
		{
			$file = ABSPATH . preg_replace("/http:\/\/.*?\//i", "", $image->guid);
		}

		$size = getimagesize($file);
		if ($size[0] <= 1920 && $size[1] <= 1080)
		{
			return $image->guid;
		}

		$copied_src = $_SERVER['DOCUMENT_ROOT'] . "/wp-content/uploads/optimized/" . $img_name;
		$copied_url = "/wp-content/uploads/optimized/" . $img_name;

		if (!file_exists($copied_src)) {

			copy($file, $copied_src);			
			exec ('mogrify -resize 1920x1080 ' . $copied_src);			
		}

		return $copied_url;
	}

	/**
	 * Downloads image
	 */
	static function downloadImage()
	{
		$im = self::getImageRequest();		
		$waterm = new Image_Watermark();

		$copied_src = $_SERVER['DOCUMENT_ROOT'] . "/wp-content/uploads/temp/" . $im['name'];

		copy($im['src'], $copied_src);

		exec ('mogrify -resize 1600x800 ' . $copied_src);		

		$imagepath = $waterm->do_watermark_public($copied_src);
		
		header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename='. $im['name']);
	    header('Content-Transfer-Encoding: binary');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($imagepath));
	    ob_clean();
	    flush();
	    readfile($imagepath);

	    unlink($imagepath);
	    unlink($copied_src);
		exit;
	}

	static function getVenueAddress($venueId)
	{
		global $wpdb;
		
		$venue = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'venues WHERE id = ' . $venueId, ARRAY_A);

		return (is_array($venue) ? $venue['address'] : '');
	}

	static function nextNextUrl($same_term = true, $exluded_terms = '')
	{
		$link = get_permalink(get_adjacent_post($same_term,$exluded_terms,true));

		if(strpos($link, $_SERVER['REQUEST_URI']) > 0)
		{
			$link = '';
		}
		return $link;
	}

	static function nextPrevUrl($same_term = true, $exluded_terms = '')
	{
		$link = get_permalink(get_adjacent_post($same_term,$exluded_terms,false));

		if(strpos($link, $_SERVER['REQUEST_URI']) > 0)
		{
			$link = '';
		}

		return $link;
	}

	static function rewriteAttachSlug( $return, $id, $title, $new_slug)
	{
		
		$post = get_post($id );


		if($post->post_type == 'attachment')
		{
			$return = preg_replace(
				'/\<span id=\"sample-permalink\" tabindex=\"-1\"\>(.*)<span id=\"editable-post-name\"/',
				'<span id="sample-permalink" tabindex="-1">$1attachment/<span id="editable-post-name"', $return); 
		}
	

		return $return;
	}

	/**
	 * Cuts string and add '...'
	 * 
	 * @param  string  $str 
	 * @param  integer $len 
	 * @return string
	 */
	static function titleCut($str,$len = 1000){

		if(strlen($str)>$len){
			return mb_substr ($str,0,$len,"UTF-8")."...";
		}else{
			return $str;
		}
	} 

	static function rt_image_attachment_fields_to_edit($form_fields, $post) 
	{
        $form_fields["post-name"] = array(
        "label" => __("File URL part"),
        "input" => "text", // default
        "value" => $post->post_name,
                //"helps" => __("To be used with special slider added via [rt_carousel] shortcode."),
	    );
		return $form_fields;
	}

	static function rt_image_attachment_fields_to_save($post, $attachment) 
	{
	    // $attachment part of the form $_POST ($_POST[attachments][postID])
	        // $post['post_type'] == 'attachment'
	    if( isset($attachment['post-name']) ){
	        // update_post_meta(postID, meta_key, meta_value);
	        //$post->post_name= $attachment['post-name'];
	        $post['post_name']= $attachment['post-name'];
	    }
	    return $post;
	}

	/**
	 * Returns post thumbnail
	 * 
	 * @param  string $post_id 
	 * @param  string $size    
	 * @return string          
	 */
	static function thumbUrl($post_id = '', $size = 'thumbnail')
	{
		global $post;

		if($post_id == '')
		{
			$post_id = $post->ID;
		}

		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), $size);

		return $thumb[0];
	}

	/**
	 * Renders div with fixed width/height and covering back (thumbnail pic)
	 * 	
	 * @param  string $post_id
	 * @param  string $size   
	 * @param  string $height 
	 * @param  string $class  
	 */
	static function thumbDiv($post_id = '', $size = 'thumbnail', $height = '180', $class = '')
	{
		?><div class="<?=$class?>" style="height: <?=$height?>px; background: url(<?=CUtil::thumbUrl($post_id, $size)?>) no-repeat center center; background-size: cover"></div><?
	}


	/**
	 * Returns current_tax
	 * @return object
	 */
	static function curr_taxonomy()
	{
		if( is_tax() ) 
		{
		    global $wp_query;
		    $term = $wp_query->get_queried_object();

		    return get_taxonomy($term->taxonomy);
		}
	}
	
	/**
	 * Returns wp objects from WP_Query
	 * @param  array $args     
	 * @param  string $template 
	 * @return array      
	 */
	static function custom_wp_query($args = Array(), $template = '')
	{
		$out = array();

		if(!isset($args['posts_per_page']))
		{
			$args['posts_per_page'] = 1000;
		}

		$query = new WP_Query($args);
		$query_cnt = 0;

		if($query->have_posts())
		{		
			while($query->have_posts()) 
			{
				$query_cnt++;
				$query->the_post();

				if($template != '' && file_exists(__DIR__ . '/includes/loops/' . $template . '-loop.php'))
				{
					include(__DIR__ . '/includes/loops/' . $template . '-loop.php');
				}else{

					the_content();
				}
			}
		}
		
		$out['posts_count'] = $query_cnt;
		wp_reset_query();

		return $out;
	}

	/**
	 * Renders post
	 * @param  object $attr param with object
	 *     - additional_args - custom args
	 */
	static function show_post($attr)
	{
		if(empty($attr['additional_args'])) $attr['additional_args'] = Array();

		if(!$attr['id'] && isset($attr['template']) && $attr['template'] != '' && file_exists( __DIR__ . '/includes/' . $attr['template'] . '.php')){

			include( __DIR__ . '/includes/' . $attr['template'] . '.php');
		}else{

			$query = new WP_Query(array_merge(Array('p' => $attr['id'],"post_status" => 'publish', 'post_type'=>'any'), $attr['additional_args']));

			if($query->have_posts())
			{
				while($query->have_posts()): $query->the_post();

					if(isset($attr['template']) && $attr['template'] != '' && file_exists( __DIR__ . '/includes/' . $attr['template'] . '.php')){
						
						include( __DIR__ . '/includes/' . $attr['template'] . '.php');
					}else{
						the_content();
					}
				endwhile;
			}
		}
	}

	/**
	 * Adding filter
	 * 
	 * @param string $hook      
	 * @param function $callback
	 * @param string $priority  
	 */
	static function add_filter($hook, $callback, $priority = "", $accepted_args = Array())
	{	
		add_filter($hook, "clbk_" . mt_rand(0,10000000000), $priority, $accepted_args);
	}
}
?>