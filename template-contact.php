<?
/*
* Template name: Contacts
*/
get_header();
  $post = new WP_QUery(array('p' => 994, 'post_type' => 'page'));
  $post->the_post();

?>


<style type="text/css">
  .fotorama__img{
    height: 100%!important;
    width: auto!important;
    top: 0!important;
    margin: 0 auto!important;
    left: 0!important;
  }
  </style>

    <div class="gallery-box main-gallery gallery-box--page-home blur-one-page">
      
      <div class="fotorama" data-autoplay="7000" data-allowfullscreen="true">
         <?=get_the_post_thumbnail($post->ID,'full');?>
      </div>

    </div>
    
    <div class="contentBox contentPost">
      <div class="watch-window contact">
        <div class="header-window">
          <table cellpadding="0" cellspacing="0" border="0">
          <tr>
          <td class="left-header-window">
            
          </td>
          <td class="center-header-window">
            <h1>Contact Us</h1>
          </td>
          <td class="right-header-window"></td>
          </tr>
          </table>
        </div>
        <div class="content-window">
          <? $contacts = simple_fields_fieldgroup('contacts_c');
          $i = 0;
          foreach($contacts as $cont){
            $i++;
            ?>
          <div class=" map-block">
            <p><?=$cont['fil_name']?></p>
            <?php if($i==1){ ?>
            <div><?=$cont['map']?>

            <? if($cont['under_const']){?>
            <p class="rec">Location Under Construction</p>
            <?}?>
            </div>
            <?php }else echo "<p>(312) 335-9999</p>"; ?>
            <? if(!$cont['under_const']){?>
            <p><?=$cont['addr']?></p>
            <p><?=$cont['phone']?></p>
            <a href="#">Get Directions</a>
            <?}?>
            
          </div>
          <?}?>
         
          <form accept-charset="UTF-8" id="submit_form" name="submit_form">
            <label>
              <p>Name: </p>
              <input name="sub_name" type="text" data-title="Name">
            </label>
            <label class="col-2">
              <p>Phone: </p>
              <input name="sub_phone" type="text" data-title="Phone">
            </label>
            <label class="col-2">
              <p>Email: </p>
              <input name="sub_email" type="email" required  data-title="Email">
            </label>
            <label class="col-2">
              <p>Date of Event: </p>
              <input name="sub_date" type="date" required type="text" data-title="Date of Event">
            </label>
            <label class="col-2">
              <p>Guest Count: </p>
              <input name="sub_guest_num" type="text" data-title="Guest Count">
            </label>
            <label class="col-2">
              <p>Event Location: </p>
              <input name="sub_rec_location" type="text" data-title="Event Location">
            </label>
            <label class="col-2">
              <p>Floral & Decor Budget: </p>
              <input name="sub_budget" type="text" data-title="Floral & Decor Budget">
            </label>
            <label>
              <p>Comments: </p>
              <textarea name="sub_comment" data-title="Comments"></textarea>
            </label>
            <label>
              <button  id="edit-submit" name="send" value="Send Message" >Send</button>
            </label>
          </form>
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

     <script src="http://swip.codylindley.com/jquery.popupWindow.js"></script>
     <script src="<?=TPL?>/assets/js/contactForm.js"></script>

  </div> 
  <?get_footer()?>