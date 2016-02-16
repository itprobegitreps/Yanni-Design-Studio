<? 
$wp_body_class = "landing";
get_header();

global $post;

$post_out = $wp_query->queried_object;


$parent_post = get_post($post_out->post_parent);

preg_match('/\[gallery.*ids=\"(.*)\"\]/', $parent_post->post_content, $preg); 

$imgs = explode(',', $preg[1]);

$startIndex = array_search($post_out->ID, $imgs);
?>
  <style type="text/css">
    body.landing .info-box {
        bottom: 0;
    }
    .info-box__wrap--simple{
    bottom:70px;
    }
    .gallery-box--page-home .fotorama__nav-wrap{display: block}
      </style>
    <div class="gallery-box main-gallery gallery-box--page-home">
        <div class="fotorama" class="fotorama"
            data-startindex="<?=$startIndex?>"
           data-transition="crossfade"
            data-nav="thumbs"
           data-allowfullscreen="native"
           data-keyboard="false"
           data-swipe="false"
           data-click="false"
           data-arrows="false">    
           <?
            foreach ($imgs as $img_id) {
            $attach_meta = get_post($img_id);
            $alt = get_post_meta($attach_meta->ID, '_wp_attachment_image_alt', true );
           
            $attach_src = CUtil::getOptimizedImage($img_id);?>
            <img title="<?=$attach_meta->post_title?>" alt="<?=$alt?>" src=<?=$attach_src?>>
        <?}?>
        </div>
    </div>

      <? include('includes/template-parts/part-design.php');?>
      <? include('includes/template-parts/part-venue.php');?>
      <? include('includes/template-parts/part-recent.php');?>

<div class="metas-container">
    <div class="info-box info-box--page-home">
      <div class="info-box__wrap info-box__wrap--simple">
        <div class="info-header">
          <p><?=$post_out->post_title?></p>
          
          <div class="social-icons">
            <?=CUtil::getSocials(get_permalink(), get_the_title( ), wp_get_attachment_image_src($wp_query->queried_object->ID, 'medium')[0]);?>
            <a href="mailto:?body=http://<?=$_SERVER['SERVER_NAME']?>/api/share/<?=$wp_query->queried_object->ID?>   <? the_title()?>" target="_blank" class="social-icons__icon social-icons__icon--normal social-icons__icon--mail"></a>
            <a href="<?=wp_get_attachment_url()?>" class="social-icons__icon social-icons__icon--normal social-icons__icon--download"></a>
          </div>
        </div><br>
        <p><?=$post_out->post_content?></p>
        <br>
        <? $venue_id = get_post_meta($post_out->ID, '_venue', true);?>
        <p>Location: <?=CUtil::getVenueLocation($venue_id)?>
        <br>
        Address: <?=CUtil::getVenueAddress($venue_id)?></p>

      </div>
      <div class="fotorama__nav-wrap"></div>

      </div>
</div>
<script>
  Globals.footer_thumbs = true;
</script>

    <div class="footer">
    </div>
    <? get_footer()?>
    </body>
</html>