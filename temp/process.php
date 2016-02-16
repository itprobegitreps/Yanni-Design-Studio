<?

function get_image_sizes( $size = '' ) {

        global $_wp_additional_image_sizes;

        $sizes = array();
        $get_intermediate_image_sizes = get_intermediate_image_sizes();

        // Create the full array with sizes and crop info
        foreach( $get_intermediate_image_sizes as $_size ) {

                if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

                        $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
                        $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
                        $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );

                } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

                        $sizes[ $_size ] = array( 
                                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
                        );

                }

        }

        // Get only 1 size if found
        if ( $size ) {

                if( isset( $sizes[ $size ] ) ) {
                        return $sizes[ $size ];
                } else {
                        return false;
                }

        }

        return $sizes;
}
?>
<?


if(is_array($_POST['batchRows']))
{     
    foreach($_POST['batchRows'] as $row)
    {        
        $sizes_array = get_image_sizes();

        require_once(ABSPATH . 'wp-admin/includes/image.php');

        $id = $row['id'];
        $src = $row['src'];

        $src = str_replace("http://blog.yannidesignstudio.com", "", $src);
        $src = str_replace("http://ydsnew.itprobe.us", "", $src);

        $img = wp_get_image_editor(ABSPATH . $src);

        try
        {
            $img->multi_resize($sizes_array);
            /*$attach_data = wp_generate_attachment_metadata($id, ABSPATH . $src);
            echo json_encode($attach_data);
            wp_update_attachment_metadata($id, $attach_data);*/
        }
        catch (Exception $e)
        {
            echo "Error (File: " . $e->getFile() . ", line " . $e->getLine() . "): " . $e->getMessage();
        }
    }   

    echo "success";

    die();
}

if($_GET['processThumbs'] == 'Y')
{
    $start = microtime(true); 
    $sizes_array = get_image_sizes();

    require_once(ABSPATH . 'wp-admin/includes/image.php');
    global $wpdb;

    if(IntVal($_GET['page']) == 0) die("PAGE INVALID");

    $page = $_GET['page'];

    $rows = $wpdb->get_results("SELECT ID, guid FROM wp_posts WHERE post_type = 'attachment' ORDER BY ID ASC LIMIT " . 20 * $page . ",20");

    $json = Array("cnt" => count($rows));

    foreach($rows as $row)
    {
        $id = $row->ID;
        $src = $row->guid;      

        $src = str_replace("//", "", $src);
        $src = str_replace("//", "", $src);
        $src = str_replace("http:blog.yannidesignstudio.com/", "", $src);
        $src = str_replace("http:ydsnew.itprobe.us/", "", $src);

        $attach_data = wp_generate_attachment_metadata($id, ABSPATH . $src);      
        wp_update_attachment_metadata($id, $attach_data);        
    }
    $json['time'] = (microtime(true) - $start);

    echo json_encode($json);

    die();
}

?>