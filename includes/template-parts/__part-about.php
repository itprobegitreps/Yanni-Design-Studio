  <? 
  $post = new WP_QUery(array('p' => 898, 'post_type' => 'page'));
  $post->the_post();
  ?>
    <div class="contentBox contentAbout">
      <div class="watch-window about">
        <div class="header-window">
          <table cellpadding="0" cellspacing="0" border="0">
          <tr>
          <td class="left-header-window">
            
          </td>
          <td class="center-header-window">
            <h1><? the_title()?></h1>
          </td>
          <td class="right-header-window"></td>
          </tr>
          </table>
        </div>
        <div class="content-window">
          <? the_content()?>          
          <hr>
          <h1>Our Team</h1>
          <div onclick="sliderUp()" class="wrapp-arr-down up">
            <a><img src="<?=TPL?>/img/arrow-up.png"></a>
          </div>
          <div class="verical-slider">
            <? 
            $abouts = simple_fields_fieldgroup('about');

            foreach($abouts as $about){?>

              <div class="team-men">
                <img src="<?=$about['Photo']['image_src']['thumbnail'][0]?>" width="14%" height="auto">
                <span><?=$about['f_name']?></span>
                <p><?=$about['dscr']?></p>
              </div>
            <?}?>
          </div>
          <div onclick="sliderDown()" class="wrapp-arr-down">
            <a ><img src="<?=TPL?>/img/arrow-down.png"></a>
          </div>
        </div>
      </div>
         <script type="text/javascript">

    function sliderUp()
    {
      $('.verical-slider').slick('slickNext');
    }

    function sliderDown()
    {
      $('.verical-slider').slick('slickPrev');
    }
    </script> 
    </div>
   