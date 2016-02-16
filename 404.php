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

    <div class="gallery-box gallery-box--page-home blur-one-page">
      
      <div class="fotorama" data-autoplay="7000" data-allowfullscreen="true">
         <?=get_the_post_thumbnail(1013, 'full');?>
      </div>

    </div>
    <? $post = get_post(1013);?>
    <div class="contentBox contentPost">
      <div class="watch-window about">
        <div class="header-window">
          <table cellpadding="0" cellspacing="0" border="0">
          <tbody><tr>
          <td class="left-header-window">
            
          </td>
          <td class="center-header-window">
            <h1><?=$post->post_title?></h1>
          </td>
          <td class="right-header-window"></td>
          </tr>
          </tbody></table>
        </div>
        <div class="content-window">
            <p style="    font-size: 19px!important;"><?=$post->post_content?></p>
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

    <div class="footer"></div>

  </div> 
  <?get_footer()?>