  <? get_header();
  global $wp_query;
  $cat_id = $wp_query->queried_object->term_id;
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

.makeItScrollable_content{
  float:left;
}
  </style>


    <div class="gallery-box main-gallery gallery-box--page-home blur-one-page">
      
      <div class="fotorama" data-autoplay="7000" data-allowfullscreen="true">
        <?

        if($cat_id != 20) // if category is Blog
        {
            echo get_the_post_thumbnail(1011, 'full_HD_1920');
        }else{

            // Or category is Reviews
            echo get_the_post_thumbnail(1009, 'full_HD_1920');
        }
        ?>
      </div>

    </div>
   
    <div class="contentBox contentPost blog-page">
      <div class="watch-window reviews">
        <div class="header-window">
          <table cellpadding="0" cellspacing="0" border="0">
          <tr>
          <td class="left-header-window">
            <input type="text" name="seachcat" id="reviews-search" placeholder="Search..." style="text-align: left">
          </td>
          <td class="center-header-window">
            <h1><? single_cat_title( );?></h1>
          </td>
          <td class="right-header-window"></td>
          </tr>
          </table>
        </div>
        <?
        $posts = Array();
     

            if($cat_id != 20) // if category is Blog
            {
                $rev = new WP_Query(array('posts_per_page' => -1,'cat' => -20, 'orderby' => 'date', 'order' => 'desc'));
                if($rev->have_posts()):
                while($rev->have_posts()): $rev->the_post();

                    if(!is_array($posts[get_the_date('F Y')]))
                    {
                      $posts[get_the_date('F Y')] = Array();
                    }

                    $posts[get_the_date('F Y')][] = $post; 
                endwhile?>         
            <? endif;
            }else{  
                // Or category is Reviews

                $rev = new WP_Query(array('posts_per_page' => -1,'cat' => 20, 'orderby' => 'date', 'order' => 'desc'));
                if($rev->have_posts()):
                while($rev->have_posts()): $rev->the_post();

                    if(!is_array($posts[get_the_date('F Y')]))
                    {
                      $posts[get_the_date('F Y')] = Array();
                    }

                    $posts[get_the_date('F Y')][] = $post; 
                endwhile?>         
            <? endif;
            }?>
        <div class="content-window">
          <div class="rev-nav">
            <div class="wrapp-rev">
            <? foreach ($posts as $key => $post_line) {?>
                <div class="month"><strong class="active"><?=$key?>:</strong>
            <?
                foreach ($post_line as $post) {?>
                <a href="<?=get_permalink($post->ID);?>"><?=$post->post_title?></a>        
            <?}?>

            </div>
            <?}?>   
            </div>        
          </div>
          <div class="wrapp-revs reviews"></div>
          <div class="reviews-posts-container" style="display:none">
           <?          
           if($cat_id != 20) // if category is Blog
            {
                $rev = new WP_Query(array('posts_per_page' => -1,'cat' => -20, 'orderby' => 'date', 'order' => 'desc'));
                if($rev->have_posts()):
                    while($rev->have_posts()): $rev->the_post();
                        include( __DIR__ . '/includes/template-parts/blog-item.php');
                    endwhile      ;
                endif;
            }else{
                // Or category is Reviews

                $rev = new WP_Query(array('posts_per_page' => -1,'cat' => 20, 'orderby' => 'date', 'order' => 'desc'));

                if($rev->have_posts()):
                    while($rev->have_posts()): $rev->the_post();
                        include( __DIR__ . '/includes/template-parts/blog-item.php');
                    endwhile      ;
                endif;
            }?>
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
         <? include('includes/template-parts/footer-icons.php');?>
        </div>
      </div>
    </div>

    <div class="footer"></div>
    <script type="text/javascript">
    $(function()
    {
        Router.fnc.Reviews();
    })
      </script>

<? get_footer();?>