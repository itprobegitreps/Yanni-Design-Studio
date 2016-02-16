    <div class="contentBox contentVideo">
      <div class="watch-window video">
       <div class="header-window">
          <table cellpadding="0" cellspacing="0" border="0">
          <tr>
          <td class="left-header-window">
            
          </td>
          <td class="center-header-window">
            <h1>Video Gallery</h1>
          </td>
          <td class="right-header-window"></td>
          </tr>
          </table>
        </div>
        <div class="content-window">
          <div class="gallery-box gallery-box--page-home">
      
            <div class="fotorama"
                 data-transition="crossfade"
                 data-nav="thumbs"
                 data-autoplay="7000"
                 data-allowfullscreen="native"
                 data-keyboard="true"
                 data-arrows="false"
            >
            <? $links = $wpdb->get_results('SELECT DISTINCT name FROM ' . $wpdb->prefix . 'videos', ARRAY_A);
            foreach ($links as $links) {?>
                <a href="http://youtube.com/watch?v=<?=$links['name']?>"></a>
            <?}?>              
            </div>
          </div>
        </div>
      </div>
    </div>