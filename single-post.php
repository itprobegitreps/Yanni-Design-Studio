<? get_header();
wp_reset_query();
$curr_cat = array_shift((get_the_category()));

$posts = Array();
        
  if($curr_cat->term_id == 20)
  {
    $blogs = new WP_Query(array('posts_per_page' => -1, 'cat' => 20, 'orderby' => 'post_date', 'order' => 'desc'));  
  }else{
    $blogs = new WP_Query(array('posts_per_page' => -1, 'cat' => -20, 'orderby' => 'post_date', 'order' => 'desc'));
  }
  
  if($blogs->have_posts()): 
        
   while($blogs->have_posts()): $blogs->the_post();

      if(!is_array($posts[get_the_date('F Y')]))
      {
          $posts[get_the_date('F Y')] = Array();
      }

      $posts[get_the_date('F Y')][] = $post;
    endwhile; wp_reset_postdata();?>        
<? endif;
?>

  <style type="text/css">
  .fotorama__img{
    height: 100%!important;
    width: auto!important;
    top: 0!important;
    margin: 0 auto!important;
    left: 0!important;
  }
  div.scroll_line{
  position: absolute;
  width: 8px;
  border: solid 1px #AAA;
  border-radius: 4px;
  right: 10px;
  height: 100%;
}
  
div.scroller{
  position: absolute;
  background: #FB0BFB;
  width: 8px;
  height: 24px;
  min-height: 12px;
  cursor: pointer;
  border-radius: 4px;
  z-index:5;
  top: 0px;
}
.wrapp-rev{
  height: 100%!important;
  overflow: hidden;
  padding-right: 30px;
}
.rev-content{
  overflow: hidden;
  width: 100%;
  float: left;
  padding-right: 30px;
  height: 55vh;
}
.rev-content-wrapp{
  height: 100%!important;
}

.makeItScrollable_content{
  float:left;
}
  </style>
<div class="gallery-box main-gallery gallery-box--page-home blur-one-page">
      
      <div class="fotorama" data-autoplay="7000" data-allowfullscreen="true">
        <?

        if($curr_cat->term_id != 20) // if category is Blog
        {
            echo get_the_post_thumbnail(1011, 'full_HD_1920');
        }else{

            // Or category is Reviews
            echo get_the_post_thumbnail(1009, 'full_HD_1920');
        }
        ?>
      </div>

    </div>

    <div class="contentBox contentPost contentblog">
      <div class="watch-window reviews single">
        <div class="header-window">
          <table cellpadding="0" cellspacing="0" border="0">
          <tr>
          <td class="left-header-window">
            <input type="text" name="seachcat" id="reviews-search" placeholder="Search..." style="text-align: left">
          </td>
          <td class="center-header-window">
            <h1><?=($curr_cat->term_id == 20 ? "Reviews" : "Blog");?></h1>
          </td>
            <td class="right-header-window">
                <? 
                if($curr_cat->term_id == 20)
                {
                    if(CUtil::nextNextUrl() != '')
                    {?>
                        <a href="<?=CUtil::nextNextUrl()?>" class="next-rev">Next Post >></a>
                    <?}
                    if(CUtil::nextPrevUrl())
                    {?>
                        <a href="<?=CUtil::nextPrevUrl()?>"><< Prev Post</a>
                    <?}?>
                    <a href="/reviews" class="close-rev"><<< Back</a>
                <?}else{

                    if(CUtil::nextNextUrl(false,'20') != '')
                    {?>
                        <a href="<?=CUtil::nextNextUrl(false,'20')?>" class="next-rev">Next Post >></a>
                    <?}
                    if(CUtil::nextPrevUrl(false,'20'))
                    {?>
                        <a href="<?=CUtil::nextPrevUrl(false,'20')?>"><< Prev Post</a>
                    <?}?>
                    <a href="/blog" class="close-rev"><<< Back</a>
                <?}?>
            </td>
          </tr>
          </table>
        </div>
        <div class="content-window">
          <div class="rev-nav">
            <div class="wrapp-rev">
            <? foreach ($posts as $key => $post_line) {?>
                <div class="month"><strong class="active"><?=$key?>:</strong>

            <?
                foreach ($post_line as $post) {?>
                <a href="<?=get_permalink($post->ID);?>"><?=$post->post_title?></a>        
            <?}?></div>
            <?}?> 
            </div>   
          </div>
          <div class="wrapp-revs">
              <div class="head-rev">
                <span><?=$wp_query->queried_object->post_title?></span>
                <? $date = new DateTime($wp_query->queried_object->post_date)?>
                <span><?=$date->format('F n\t\h Y')?></span>
                <div class="social-icons">
                    <? CUtil::getSocials(get_permalink($wp_query->queried_object->ID), $wp_query->queried_object->post_title)?>
               </div>
              </div>
              <div class="rev-content">
                <div class="rev-content-wrapp">
                <div class="scroll_content_rev">
                  <? the_content();?>
                  </div>
                </div>
              </div>
          </div>
       
        </div> 
      </div>
    </div>

      <? include('includes/template-parts/part-design.php');?>
      <? include('includes/template-parts/part-venue.php');?>
      <? include('includes/template-parts/part-recent.php');?>

    <div class="info-box info-box--page-home">
      <div class="info-box__wrap info-box__wrap--simple">
        <div class="social-icons">
          <a href="<?=get_option('fb_url_main');?>" class="social-icons__icon social-icons__icon--normal social-icons__icon--facebook"></a>
          <a href="<?=get_option('pn_url_main');?>" class="social-icons__icon social-icons__icon--normal social-icons__icon--pinterest"></a>
          <a href="<?=get_option('is_url_main');?>" class="social-icons__icon social-icons__icon--normal social-icons__icon--instagram"></a>
        </div>
      </div>
    </div>
    <script src="http://swip.codylindley.com/jquery.popupWindow.js"></script>

            <script type="text/javascript">
            Globals.footer_thumbs = true;
            $(function()
            {
                /*$('.share_link').popupWindow({ 
                    width:550, 
                    height:400,
                    centerBrowser:1
                });*/

              Router.fnc.Reviews();
            });
            </script>   

    <div class="footer"></div>

  </div>

  <script type="text/javascript">

    $(".wrapp-rev").makeItScrollable({

        containerElementaryUnit: '.month strong',

        stepSize: [0.1, 'units'],

      });

    $(".rev-content-wrapp").makeItScrollable({

        containerElementaryUnit: '.scroll_content_rev p',

        stepSize: [0.1, 'units'],

      });

  </script>

  <? get_footer()?>