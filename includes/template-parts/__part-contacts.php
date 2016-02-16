    
 <? 
  $post = new WP_QUery(array('p' => 994, 'post_type' => 'page'));
  $post->the_post();
  ?>
    <div class="contentBox contentContact">
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
      
          foreach($contacts as $cont){

            ?>
          <div class=" map-block">
            <p><?=$cont['fil_name']?></p>
            <div><?=$cont['map']?>

            <? if($cont['under_const']){?>
            <p class="rec">Location Under Construction</p>
            <?}?>
            </div>
            <p><?=$cont['addr']?></p>
            <p><?=$cont['phone']?></p>
            <a href="#">Get Directions</a>
          </div>
          <?}?>
         
          <form onsubmit="return validateForm()" accept-charset="UTF-8" id="submit_form" name="submit_form">
            <label>
              <p>Name: </p>
              <input name="sub_name" type="text">
            </label>
            <label class="col-2">
              <p>Phone: </p>
              <input name="sub_phone" type="text">
            </label>
            <label class="col-2">
              <p>Email: </p>
              <input name="sub_email" type="text">
            </label>
            <label class="col-2">
              <p>Date of Event: </p>
              <input name="sub_date" type="date" type="text">
            </label>
            <label class="col-2">
              <p>Guest Count: </p>
              <input name="sub_guest_num" type="text">
            </label>
            <label class="col-2">
              <p>Event Location: </p>
              <input name="sub_rec_location" type="text">
            </label>
            <label class="col-2">
              <p>Floral Budget: </p>
              <input name="sub_budget" type="text">
            </label>
            <label>
              <p>Comments: </p>
              <textarea name="sub_comment"></textarea>
            </label>
            <label>
              <button  id="edit-submit" name="send" value="Send Message" >Send</button>
            </label>
          </form>
        </div>
      </div>
    </div>