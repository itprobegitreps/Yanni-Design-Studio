<?
/*
* Template name: Front
*/
?>
<? get_header()?>

  <style type="text/css">
  .fotorama__img{
    height: 100%!important;
    width: auto!important;
    top: 0!important;
    margin: 0 auto!important;
    left: 0!important;
  }
  </style>

    <div class="gallery-box main-gallery gallery-box--page-home">
      <div class="fotorama" data-autoplay="7000" data-allowfullscreen="true" data-nav="thumbs"         
           data-allowfullscreen="native"
           data-keyboard="true"
           data-arrows="false"
	    data-loop="true">
        <?
                   
          $parent_post = get_post(2404);

          preg_match('/\[gallery.*ids=\"(.*)\"\]/', $parent_post->post_content, $preg); 

          $imgs = explode(',', $preg[1]);

          foreach ($imgs as $image_id) {          

              $attach_src = CUtil::getOptimizedImage($image_id);
              ?>
              
              <img src="<?=$attach_src?>">
            <?} ?>
      </div>
   
    </div>

      <? include('includes/template-parts/part-design.php');?>
      <? include('includes/template-parts/part-venue.php');?>
      <? include('includes/template-parts/part-recent.php');?>
   

    <div class="info-box info-box--page-home">
      <div class="info-box__wrap info-box__wrap--simple">
        <div class="social-icons">
        <? include('includes/template-parts/footer-icons.php');?>
        </div>
      </div>
    </div>

    <div class="footer"></div>

     <script src="http://swip.codylindley.com/jquery.popupWindow.js"></script>

            <script type="text/javascript">
            $(function()
            {
                $('.share_link').popupWindow({ 
                    width:550, 
                    height:400,
                    centerBrowser:1
                });
            });
            </script>   

  </div> 
  <?get_footer()?>