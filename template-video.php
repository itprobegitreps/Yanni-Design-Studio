<? 
/*
* Template name: Video
*/
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
  }
  .info-box__wrap.info-box__wrap--normal.normal{
    text-align: center;
  }
  .info-box__wrap.info-box__wrap--normal.normal a{
    float: none;
    display: inline-block;
    text-align: center;
  }

  }

  </style>
    <div class="gallery-box main-gallery gallery-box--page-home">
        <div class="fotorama" class="fotorama"           
           data-nav="thumbs"         
           data-allowfullscreen="native"
           data-keyboard="true"
           data-arrows="false"
	    data-loop="true">
         <? $links = $wpdb->get_results('SELECT DISTINCT name, title, description, sort FROM ' . $wpdb->prefix . 'videos', ARRAY_A);
         	$count = count($links);
         	for($i=1;$i<=$count;$i++){
            foreach ($links as $link){
            	if($i == $link['sort']){ ?>
                <a href="http://youtube.com/watch?v=<?=$link['name']?>"  data-caption="<h3><?=$link['title']?$link['title']:none?></h3><p><?=$link['description']?$link['description']:none?></p>"></a>
            <?php }}} ?>   
        </div>
    </div>


      <? include('includes/template-parts/part-design.php');?>
      <? include('includes/template-parts/part-venue.php');?>
      <? include('includes/template-parts/part-recent.php');?>
      
       <div class="metas-container">
    <?

    $cnt = -1;

        foreach ($links as $link) {$cnt++;?>
    <div class="metas meta<?=$cnt?>">
    <div class="info-box info-box--page-gallery">
        <div class="info-box__wrap info-box__wrap--normal normal">       
            <div class="social-icons">
                <a data-toggle="tooltip" data-placement="top" data-original-title="Play slideshow" Twitter class="social-icons__icon social-icons__icon--normal social-icons__icon--play autoplay" href="#"></a>
                <a data-toggle="tooltip" data-placement="top" data-original-title="Stop slideshow"  class="social-icons__icon social-icons__icon--normal social-icons__icon--stop stopplay"  style="display:none;" href="#"></a>
                <? CUtil::getSocials( 'http://youtube.com/watch?v=' . $link['name'], $link['title'], 'http://youtube.com/watch?v=' . $link['name'], true);?>
                <a data-toggle="tooltip" data-placement="top" data-original-title="Mail - Share this page by email"  href="mailto:?body=http://youtube.com/watch?v=<?=$link['name']?>" target="_blank" class="share_link social-icons__icon social-icons__icon--normal social-icons__icon--mail"></a>
        </div>
    </div>
    </div>
    </div>

    <? } ?>
    </div>
    <script src="http://swip.codylindley.com/jquery.popupWindow.js"></script>          
    <style>.info-box--page-gallery{height:100px;}.info-box__wrap.info-box__wrap--normal.normal{margin-top:33px;}</style>
    <script>
    Globals.footer_thumbs = true;
    $(function(){
      Router.fnc.Video();

      $(".fotorama").on("fotorama:loadvideo",function()
      {
        $(".metas-container").fadeOut();
      });

      $(".fotorama").on("fotorama:unloadvideo",function()
      {
        $(".metas-container").fadeIn();
      });

      Router.parts.autoPlayControl();
                $(".autoplay").click();

                $('.fotorama')
                    // Listen to the events
                .on('fotorama:showend', function(ev)
                {                        
                    var index = $(".fotorama").data("fotorama").activeIndex;                        
                    $(".metas").not(".meta" + index).hide();
                    $(".meta" + index).show();
                });
    });
    </script>
    <div class="footer">
    </div>
    <? get_footer()?>
    </body>
</html>