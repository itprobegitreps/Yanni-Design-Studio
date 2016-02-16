<?php
$themename = "yanni";
global $wpdb;

$options  = $wpdb->get_results('SELECT id, name FROM ' . $wpdb->prefix . 'venues ORDER BY name ASC', ARRAY_A);

$out_options = Array();

foreach($options as $option)
{
    $out_options[$option['id']] = $option['name'];
}

$out_options[0] = 'No venue';

$attchments_options = array(
   /* 'post_name' => array(
        'label'       => __( 'Post name', $themename ),
        'input'       => 'text',    
        'application' => 'image',
        'exclusions'  => array( 'audio', 'video' ),
        'required'    => true,
        'error_text'  => __( 'Copyright field required', $themename )
    ),
    'image_author_desc' => array(
        'label'       => __( 'Image author description', $themename ),
        'input'       => 'textarea',
        'application' => 'image',
        'exclusions'   => array( 'audio', 'video' ),
    ),
    'image_stars' => array(
        'label'       => __( 'Image rating', $themename ),
        'input'       => 'radio',
        'options' => array(
            '0' => 0,
            '1' => 1,
            '2' => 2,
            '3' => 3,
            '4' => 4
        ),
        'application' => 'image',
        'exclusions'   => array( 'audio', 'video' )
    ),*/
    'main_page_order' => Array(
        'label' => 'Order on main page',
        'input' => 'input',
        'application' => 'image',
        'exclusions' => array( 'audio','video')
    ),
  /*  'on_main' => array(
        'label'       => __( 'In main gallery', $themename ),
        'input'       => 'checkbox',
        'application' => 'image',
        'exclusions'   => array( 'audio', 'video' )
    ),*/
    'venue' => array(
        'label'       => __( 'Venue', $themename ),
        'input'       => 'select',
        'options' => $out_options,
        'application' => 'image',
        'exclusions'   => array( 'audio', 'video' )
    )
);