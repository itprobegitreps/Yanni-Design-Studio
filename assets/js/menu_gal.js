  $(document).ready(function() {



	

	$('.menubutton').click(function(){

	$(this).toggleClass('opened').toggleClass('closed');
       		

	     if($(this).hasClass('opened')) {
		$('.menu_strip_gallery').hide();
		$('.menu_strip_about').hide();
		$('.menu_strip_venue').hide();
		$('.menu_strip_contactus').hide();
		$('.menu_strip_feedback').hide();
		$('.menu_strip_recent').hide();
		$('.menu_strip_subscribe').hide();
		$('.content_about').hide();
		$('.content_venue').hide();
		$('.content_contactus').hide();
		$('.content_feedback').hide();
		$('.content_gallery').hide();
		$('.content_recent').hide();
		$('.content_subscribe').hide();
            $(this).html('<center>Show Home Menu</center>');

        }

        else {
		$('.menu_strip_gallery').show();
		$('.menu_strip_about').show();
		$('.menu_strip_venue').show();
		$('.menu_strip_contactus').show();
		$('.menu_strip_feedback').show();
		$('.menu_strip_recent').show();
		$('.menu_strip_subscribe').show();
		$('.content_about').hide();
		$('.content_venue').hide();
		$('.content_contactus').hide();
		$('.content_feedback').hide();
		$('.content_gallery').hide();
		$('.content_recent').hide();
		$('.content_subscribe').hide();
            $(this).html('<center>Hide Home Menu</center>');

        }

  });

  });

  