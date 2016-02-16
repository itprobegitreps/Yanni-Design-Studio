    <div class="contentBox contentVenue">
        <div class="watch-window">
            <div class="header-window">
                <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="left-header-window"><input name="seachcat" class="venue" id="search" placeholder="Search Venue" type="text"></td>

                        <td class="center-header-window">
                            <h1>Venue Gallery</h1>
                        </td>

                        <td class="right-header-window"></td>
                    </tr>
                </table>
            </div>

            <div class="content-window venue"></div>
            <div class="galleries-venue" style="display:none">
                <? $posts = new WP_Query(array('post_type' => 'venue', 'post_status' => 'publish', 'posts_per_page' => -1, 'orderby' => 'title','order' => 'asc'));
                    if($posts->have_posts()):
                        while($posts->have_posts()):
                            $posts->the_post();
                            include( __DIR__ . '/gallery-item.php');                        
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