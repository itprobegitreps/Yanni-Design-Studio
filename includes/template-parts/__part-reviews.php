    <div class="contentBox contentReviews">
      <div class="watch-window reviews">
        <div class="header-window">
          <table cellpadding="0" cellspacing="0" border="0">
          <tr>
          <td class="left-header-window">
            <input type="text" name="seachcat" id="reviews-search" placeholder="Search..." style="text-align: left">
          </td>
          <td class="center-header-window">
            <h1>Reviews</h1>
          </td>
          <td class="right-header-window"></td>
          </tr>
          </table>
        </div>
        <?
        $posts = Array();
          $rev = new WP_Query(array('cat' => 20, 'orderby' => 'date', 'order' => 'asc'));
          if($rev->have_posts()):
              while($rev->have_posts()): $rev->the_post();
                  
                  if(!is_array($posts[get_the_date('F Y')]))
                  {
                      $posts[get_the_date('F Y')] = Array();
                  }

                  $posts[get_the_date('F Y')][] = $post; 
              endwhile?>         
          <? endif;?>  
        
        <div class="content-window">
          <div class="rev-nav">
            <? foreach ($posts as $key => $post_line) {?>
                <div class="month"><strong class="active"><?=$key?>:</strong>
            <?
                foreach ($post_line as $post) {?>
                <a href="<?=get_permalink($post->ID);?>"><?=$post->post_title?></a>        
            <?}?></div>
            <?}?>           
          </div>
          <div class="wrapp-revs reviews"></div>
          <div class="reviews-posts-container" style="display:none">
           <?          
           $rev = new WP_Query(array('cat' => 20, 'orderby' => 'date', 'order' => 'asc'));
            if($rev->have_posts()):
                while($rev->have_posts()): $rev->the_post();
                    include( __DIR__ . '/blog-item.php');
                endwhile?>         
            <? endif; ?>
        </div> 
        </div> 
      </div>
    </div>
