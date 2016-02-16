<? 
/* Single gallery template */

get_header();
the_post();
$permalink = get_permalink();?>
  <style type="text/css">
      .gallery-box--page-home .fotorama__nav-wrap{display: block}
      </style>
      <style type="text/css">
  .fotorama__img{
    height: 100%!important;
    width: auto!important;
    top: 0!important;
    margin: 0 auto!important;
    left: 0!important;
  }</style>
    <div class="gallery-box main-gallery gallery-box--page-home">
        <div class="fotorama"           
           data-nav="thumbs"         
           data-allowfullscreen="native"
           data-keyboard="true"
           data-arrows="false"
	    data-loop="true">
        <?
        preg_match('/\[gallery.*ids=\"(.*)\"\]/', $post->post_content, $preg); 
        $imgs = explode(',', $preg[1]);
        
        foreach ($imgs as $img_id) {
            $attach_meta = get_post($img_id);
            $alt = get_post_meta($attach_meta->ID, '_wp_attachment_image_alt', true );
            $attach_src = CUtil::getOptimizedImage($img_id);?>


            <img title="<?=$attach_meta->post_title?>" alt="<?=$alt?>" src="<?=$attach_src?>">
        <?}?>
        </div>
    </div>


      <? include('includes/template-parts/part-design.php');?>
      <? include('includes/template-parts/part-venue.php');?>
      <? include('includes/template-parts/part-recent.php');?>
   
   <div class="metas-container forbackb">
    <? 
    $cnt = -1;
         foreach ($imgs as $img_id) {

          $attach = get_post($img_id);

          $cnt++;?>
    <div class="metas meta<?=$cnt?>">
    <div class="info-box info-box--page-gallery">
        <div class="info-box__wrap info-box__wrap--normal normal">
            <a href="" class="show_more_a_tag">
              <p class="info-box__more-link">More Info</p>
            </a>

            <div class="social-icons">
                <a data-toggle="tooltip" data-placement="top" data-original-title="Play slideshow" Tweeter class="social-icons__icon social-icons__icon--normal social-icons__icon--play autoplay" href="#"></a>
                <a data-toggle="tooltip" data-placement="top" data-original-title="Stop slideshow"  class="social-icons__icon social-icons__icon--normal social-icons__icon--stop stopplay"  style="display:none;" href="#"></a>
                <? CUtil::getSocials(get_attachment_link($attach->ID), $attach->post_name, wp_get_attachment_image_src($attach->ID, 'medium')[0]);?>
                <a data-toggle="tooltip" data-placement="top" data-original-title="Mail - Share this page by email"  href="mailto:?body=http://<?=$_SERVER['SERVER_NAME']?>/api/download/<?=$attach->ID?>" target="_blank" class="share_link social-icons__icon social-icons__icon--normal social-icons__icon--mail"></a>
                <a data-toggle="tooltip" data-placement="top" data-original-title="Download this photo"  href="/api/download/<?=$attach->ID?>" class=" share_link social-icons__icon social-icons__icon--normal social-icons__icon--download"></a>
          </div>
        </div>
    <br>

        <div class="info-box__wrap info-box__wrap--more more">
            <div class="info-box__header">
                <h5 class="title-mini title-mini--info-box"><?=get_the_title($attach->ID );?></h5>
            </div>


            <div class="info-box__content-box">
                <p class="info-box__description-text"><?=$attach->post_content?><br>
                <br>
                 <? $venue_id = get_post_meta($attach->ID, '_venue', true);?>
                 <?if(IntVal($venue_id) > 0){?>
                 
                <p class="info-box__description-text">Location: <?=CUtil::getVenueLocation($venue_id)?>
                <br>
                Address: <?=CUtil::getVenueAddress($venue_id)?></p>
                <?}?>
            </div>
        </div>
    </div>
    </div>
    <? } ?>
    </div>
    <script src="http://swip.codylindley.com/jquery.popupWindow.js"></script>

            <script type="text/javascript">
            Globals.footer_thumbs = true;
            
            $(function()
            {
                var infoVisible = false;

                $('.fotorama')
                    // Listen to the events
                .on('fotorama:showend', function(ev)
                {                        
                    if(infoVisible)
                    {
                        hideInfo();

                        setTimeout(function()
                        {
                            var index = $(".fotorama").data("fotorama").activeIndex;                        
                            $(".metas").not(".meta" + index).hide();
                            var it = $(".meta" + index).show().find(".show_more_a_tag");

                            showInfo(it);
                        } ,400);
                    }else{
                        
                        index = $(".fotorama").data("fotorama").activeIndex;                        
                        $(".metas").not(".meta" + index).hide();
                        var it = $(".meta" + index).show().find(".show_more_a_tag");
                      
                    }
                });

                function showInfo(arg_item)
                {
                    var item = arg_item || $(".show_more_a_tag.show_info_active");
                    var height = parseInt($(item).closest(".info-box.info-box--page-gallery").find(".info-box__wrap--more").height()) + 85;

                    $(item).addClass('show_info_active').find("p").html("Less info");
                    $(item).closest(".info-box.info-box--page-gallery").css('height', height+'px');
                                                     
                }

                function hideInfo(arg_item)
                {
                    var item = arg_item || $(".show_more_a_tag.show_info_active");
                    var height = parseInt($(item).closest(".info-box.info-box--page-gallery").find(".info-box__wrap--more").height()) + 85;

                    $(item).removeClass('show_info_active').find("p").html("More info");
                    $(item).closest(".info-box.info-box--page-gallery").css('height', '50px');                                
                }

                $(".show_more_a_tag").click(function()
                {
                    infoVisible = infoVisible ? false : true;

                    if(infoVisible === true)
                    {
                        showInfo(this);
                    }else{

                        hideInfo(this);    
                    }                    

                    return false;
                });

                Router.parts.autoPlayControl();
                $(".autoplay").click();
            });
            </script>   

    <div class="footer">
    </div>
    <? get_footer()?>
    </body>
</html>