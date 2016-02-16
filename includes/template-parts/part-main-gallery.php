<div class="gallery-box gallery-box--page-home">
        <div class="fotorama" class="fotorama"
           
           data-nav="thumbs"         
           data-allowfullscreen="native"
           data-keyboard="true"
           data-arrows="false">
        <?
        preg_match('/\[gallery.*ids=\"(.*)\"\]/', $post->post_content, $preg); 

        $imgs = explode(',', $preg[1]);


        foreach ($imgs as $img_id) {
            $attach_meta = get_post($img_id);
            $alt = get_post_meta($attach_meta->ID, '_wp_attachment_image_alt', true );
           
            $attach = wp_get_attachment_url( $img_id); ?> 
            <img data-title="<?=$attach_meta->post_excerpt?>" alt="<?=$alt?>" src=<?=$attach?>>
        <?}?>
        </div>
    </div>