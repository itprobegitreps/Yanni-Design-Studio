    <div class="contentBox contentRecent">
        <div class="watch-window">
            <div class="header-window">
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="left-header-window"><input class="recent" name="seachcat" id="search" placeholder="Search Recent" type="text"></td>

                        <td class="center-header-window">
                            <h1>Recent Gallery</h1>
                        </td>

                        <td class="right-header-window"></td>
                    </tr>
                </table>
            </div>

            <div class="content-window recent"></div>
            <div class="galleries-recent" style="display:none">
                <? $posts = new WP_Query(array('post_type' => 'recent','post_status' => 'publish', 'posts_per_page' => -1, 'orderby' => 'menu_order','order' => 'asc'));
                    if($posts->have_posts()):
                        while($posts->have_posts()):
                            $posts->the_post();
                            include(__DIR__ . '/gallery-item.php');                        
                        endwhile;
                    endif;?>
            </div>

            <div class="window-naw">
                <a class="active" href="#"></a><a href="#"></a><a href="#"></a>
            </div>

             <div class="slider-left-icon"></div>
            <div class="slider-right-icon"></div>
        </div>
    </div>

