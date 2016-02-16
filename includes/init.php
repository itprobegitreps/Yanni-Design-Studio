<?php
/*
 * @package Massique
 * @subpackage Base_Theme
 */


new CInit();

/*
/ Class represents start point of theme functionality
*/

class CInit 
{
	function __construct()
	{
		if (!session_id()) 
		{
		    session_start();
		}

		define ('TPL', get_template_directory_uri());

		load_modules(__DIR__);

		$this->theme_settings();
		$this->theme_supports();
		$this->hooks();
		$this->advanced_routes();		
	}

	private function advanced_routes()
	{	
		if (strpos($_SERVER["REQUEST_URI"],'/api/download') > -1) {
			CUtil::downloadImage();
			die();
		}

		if (strpos($_SERVER["REQUEST_URI"],'/api/share') > -1) {
			CUtil::shareImage();
			die();
		}

		if(!empty($_REQUEST['method'])){
			CCallback::router();
			die();
		}
	}

	static function add_menu_pages()
	{
		add_menu_page( 'Venues gallery', 'Venue gallery', 'manage_options', 'venue-list', 'CAdminPages::Venue', '', 22 ); 
		add_submenu_page( 'venue-list', 'Add venue', 'Add venue', 'manage_options', '/post-new.php?post_type=venue');

		add_menu_page( 'Design gallery', 'Design gallery', 'manage_options', 'design-list', 'CAdminPages::Design', '', 21 ); 
		add_submenu_page( 'design-list', 'Add design', 'Add design', 'manage_options', '/post-new.php?post_type=design');		

		add_menu_page( 'Recent gallery', 'Recent gallery', 'manage_options', 'recent-list', 'CAdminPages::Recent', '', 23 ); 
		add_submenu_page( 'recent-list', 'Add recent', 'Add recent', 'manage_options', '/post-new.php?post_type=recent');

		add_menu_page( 'Image Library', 'Image Library', 'manage_options', 'image-list', 'CAdminPages::Images', '', 10 ); 
		add_submenu_page( 'image-list', 'Add image', 'Add image', 'manage_options', '/media-new.php');
	}

	private function theme_settings()
	{	
		register_nav_menu( 'primary', 'Primary Menu' );  

		if(!is_admin())
		{
			// Styles
			wp_enqueue_style('main_styles',  TPL . "/style.css");			
			wp_enqueue_style('slick' , TPL . "/assets/css/slick/slick.css");			
			wp_enqueue_style('slick_theme',  TPL . "/assets/css/slick/slick-theme.css");			
			wp_enqueue_style('fotorama',  "http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css");

			// Scripts in header
			wp_enqueue_script('jquery_yds', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js');
			wp_enqueue_script('migrate', '//code.jquery.com/jquery-migrate-1.2.1.min.js', array("jquery_yds"));
			wp_enqueue_script('fotorama', 'http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', array('jquery_yds'));
			wp_enqueue_script( "slick", TPL . "/assets/js/lib/slick.min.js", array('jquery_yds'));
			wp_enqueue_script( "validation", TPL . "/assets/js/lib/validation.js", array('jquery_yds'));
			wp_enqueue_script( "router", TPL . "/assets/js/router.js", array('jquery_yds'));
			wp_enqueue_script( "mousewheel", TPL . "/assets/js/lib/jquery.mousewheel.js", array('jquery_yds'));
			wp_enqueue_script( "all-shitty-coding", TPL . "/assets/js/lib/mixed.js", array('jquery_yds'));
			wp_enqueue_script( "scroll-script", TPL . "/assets/js/lib/scroll-script.js", array('jquery_yds'));
			wp_enqueue_script( "scroll-to-script", TPL . "/assets/js/lib/jquery.scrollto.js", array('jquery_yds'));
			wp_enqueue_script( "bootstrap-js", TPL . "/assets/js/lib/bootstrap.min.js", array('jquery_yds'));
			wp_enqueue_script( "mobile-detect", TPL . "/assets/js/lib/mobile-detect.min.js", array('jquery_yds'));
			wp_enqueue_script( "footer-common.js", TPL . "/assets/js/footer-common.js", array('jquery_yds'), "", true);
		}
	}

	private function theme_supports()
	{
		add_theme_support('post-formats', array('video'));
		add_theme_support('post-thumbnails');
	}

	private function hooks()
	{	
		add_filter( 'get_sample_permalink_html', "CUtil::rewriteAttachSlug",2, 4);	
		add_action( 'after_setup_theme', function() {
		    add_image_size( 'full_HD_1920', 1920, 1080, true );
		}, 11 );

		add_action('admin_init', function()
		{
			wp_enqueue_script('admin-custom-scripts', TPL . '/assets/js/admin-custom.js', array('jquery'));
		});
		add_action( 'admin_menu', array(__CLASS__, 'add_menu_pages') );		
		add_action( 'admin_menu', function()
		{
			 remove_menu_page( 'mvc_galleries' );
			 remove_menu_page( 'mvc_category_galleries' );
			 remove_menu_page( 'mvc_about_us_sections' );
		});

		//add_filter("attachment_fields_to_edit", "CUtil::rt_image_attachment_fields_to_edit", null, 2);
		//add_filter("attachment_fields_to_save", "rt_image_attachment_fields_to_save", null , 2);
	}
}

// Function loads WP-styled modules
function load_modules($dir_path)
{
	$directories = glob($dir_path . '/*' , GLOB_ONLYDIR);

	foreach ($directories as $dir)
	{
		$plugin_file_name = explode('/', $dir);
		$widgetpath = $dir . '/' . array_pop($plugin_file_name) . '.php';

		if(file_exists($widgetpath))
		{
			require_once $widgetpath;
		}
	}
}

function pre($str){

	echo "<pre>";
	print_r($str);
	echo "</pre>";
}




