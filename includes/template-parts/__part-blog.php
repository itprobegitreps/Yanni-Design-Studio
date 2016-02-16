    <style type="text/css">
      div.scroll_line{
        position: absolute;
        width: 8px;
        border: solid 1px #AAA;
        border-radius: 4px;
        right: 10px;
      }
        
      div.scroller{
        position: absolute;
        background: #000;
        width: 8px;
        height: 24px;
        min-height: 12px;
        cursor: pointer;
        border-radius: 4px;
        z-index:5;
        top: 0px;
      }

      .makeItScrollable_content{
        float:left;
      }
    </style>
    <div class="contentBox contentBlog">
      <div class="watch-window reviews">
        <div class="header-window">
          <table cellpadding="0" cellspacing="0" border="0">
          <tr>
          <td class="left-header-window">
            <input type="text" name="seachcat" id="blog-search" placeholder="Search..." style="text-align: left">
          </td>
          <td class="center-header-window">
            <h1><? single_cat_title();?></h1>
          </td>
          <td class="right-header-window"></td>
          </tr>
          </table>
        </div>
        <?
        $posts = Array();

        $blogs = new WP_Query(array('posts_per_page' => -1, 'cat' => -20, 'orderby' => 'post_date', 'order' => 'desc'));
        if($blogs->have_posts()): 
              
         while($blogs->have_posts()): $blogs->the_post();

            if(!is_array($posts[get_the_date('F Y')]))
            {
                $posts[get_the_date('F Y')] = Array();
            }

            $posts[get_the_date('F Y')][] = $post;
          endwhile?>         
      <? endif;
            

          ?>  
        
        <div class="content-window">
          <div class="rev-nav">
            <div class="wrapp-rev">
            <? foreach ($posts as $key => $post_line) {?>
                <strong class="active"><?=$key?>:</strong>
            <?
                foreach ($post_line as $post) {?>
                <a href="<?=get_permalink($post->ID);?>"><?=$post->post_title?></a>        
            <?}}?>
            </div>           
          </div>
          <div class="wrapp-revs blog"></div>
          <div class="blog-posts-container" style="display:none">
           <?   $blogs = new WP_Query(array('post_type' => 'post','posts_per_page' => -1, 'cat' => -20, 'orderby' => 'post_date', 'order' => 'desc'));
                if($blogs->have_posts()): 
                      
                 while($blogs->have_posts()): $blogs->the_post();
                    include( __DIR__ . '/blog-item.php');
                endwhile?>         
            <? endif;?>  
        </div> 
        </div> 
      </div>
    </div>