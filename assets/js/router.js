var Router, Globals = {};

$(function()
{	
	var displaynone = $(".display-none");
	var fotoramaAutoPlay = false;

	Router = (function()
	{
		var md = new MobileDetect(window.navigator.userAgent);
		var instance = {};
		instance.inited = {};
		instance.slickGalleryOptions = {
            dots: true,
            rows: (md.phone() !== null) ? 1000 : 3,
            slidesPerRow: (md.phone() !== null) ? 1 : 3
        };
	    instance.slickBlogOptions = {
			dots: true,
			rows: (md.phone() !== null) ? 1000 : 3
		};

		var photorama_navs = $(".fotorama__arr--next, .fotorama__arr--prev");
		

		$(".nav-header > ul > li a").not(".native").click(function(e)
		{
			var index = $(this).data('href');
			var section_visible = false;

			$(".contentBox").not(".content" + index).fadeOut();

			if($(".content" + index).css('display') != 'none')
			{
				section_visible = true;
			}

			$(".content" + index).fadeToggle();

			if(instance.inited[index] != true)			
			{
				if(instance.fnc[index]) instance.fnc[index]();
				instance.inited[index] = true;
			}

			fotorama = $(".main-gallery .fotorama").data('fotorama');			

			if(section_visible)
			{
				if(fotoramaAutoPlay)
				{
					fotorama.startAutoplay();
				}

				if(Globals.footer_thumbs)
				{
					$(".metas-container, .fotorama__nav-wrap").fadeIn();
				}

				$(".fotorama__stage").append(photorama_navs);

				$(".contentPost ").fadeIn();
				$(".main-gallery .fotorama__active").removeClass('fotorama__stopped');	
				
			}else{
				$(".contentPost").fadeOut();

				if(Globals.footer_thumbs)
				{
					$(".metas-container, .fotorama__nav-wrap").fadeOut();
				}
				
				displaynone.append(photorama_navs);
								
				fotorama.stopAutoplay();
				
				$(".main-gallery .fotorama__active").addClass('fotorama__stopped');
			}
			
			
			return false;
		});

		instance.fnc = {};

		instance.fnc.Design = function()
		{
			instance.parts.autoPlayControl();		

			var galleries = $('.galleries-design > div').clone();

	        $('.content-window.design').html(galleries).slick(instance.slickGalleryOptions);

	        $('.contentDesign .slider-left-icon').click(function()
			{
				$('.content-window.design').slick('slickPrev');
			});

			$('.contentDesign .slider-right-icon').click(function()
			{
				$('.content-window.design').slick('slickNext');
			});

	        $("#search.design").on('keyup', function()
	        {
	            var filterText = this.value;
	          
	            var filtered = galleries.clone().filter(function(index)
                {	                	
                    return $(this).find(".item-gallary")[0].innerText.toLowerCase().match(filterText.toLowerCase()) != null;
                });

	            

	            if(filterText == '')
	            {
	                $('.content-window.design').slick('unslick').html(galleries).slick(instance.slickGalleryOptions);
	            }else{
	                 $('.content-window.design').slick('unslick').html(filtered).slick(instance.slickGalleryOptions);
	            }           
	        });
		}

		instance.fnc.About = function()
		{
			$('.verical-slider').slick({
	            vertical: true,
	            swipe: false
	        }).slick('slickNext');     
		}

		instance.fnc.Venue = function()
		{
			instance.parts.autoPlayControl();

			var galleries = $('.galleries-venue > div').clone();

	        $('.content-window.venue').html(galleries);

	        $('.content-window.venue').slick(instance.slickGalleryOptions);

	        $('.contentVenue .slider-left-icon').click(function()
			{
				$('.content-window.venue').slick('slickPrev');
			});

			$('.contentVenue .slider-right-icon').click(function()
			{
				$('.content-window.venue').slick('slickNext');
			});

	        $("#search.venue").on('keyup', function()
	        {
	            var filterText = this.value;

	            var filtered = galleries.clone().filter(function(index)
                {	                	
                    return $(this).find(".item-gallary")[0].innerText.toLowerCase().match(filterText.toLowerCase()) != null;
                });

	            if(filterText == '')
	            {
	                $('.content-window.venue').slick('unslick').html(galleries).slick(instance.slickGalleryOptions);
	            }else{
	                 $('.content-window.venue').slick('unslick').html(filtered).slick(instance.slickGalleryOptions);
	            }           
	        });
		}

		instance.fnc.Reviews = function()
		{
			if(md.phone() !== null)
			{
				$(".wrapp-one-rev .img-rev").each(function()
				{
					$(this).closest(".wrapp-one-rev").find(".blog-post-excerpt").after(this);
				});	
			}
			
			var posts = $(".reviews-posts-container > div").clone();

			$('.wrapp-revs.reviews').html(posts).slick(instance.slickBlogOptions);			

			$("#reviews-search").on('keyup', function()
	        {
	            var filterText = this.value;

	            var filtered = posts.clone().filter(function(index)
	                {
	                    return $(this).find(".head-rev span")[0].innerText.toLowerCase().match(filterText.toLowerCase()) != null;
	                });

	            if(filterText == '')
	            {
	                $('.wrapp-revs.reviews').slick('unslick').html(posts).slick(instance.slickBlogOptions);
	            }else{
	                $('.wrapp-revs.reviews').slick('unslick').html(filtered).slick(instance.slickBlogOptions);
	            }   

	            $(".month").show();
	            $(".month a").removeClass('hide');

	            if(filterText != '')
	            $(".month a").each(function()
	            {
	            	if(this.innerText.toLowerCase().match(filterText.toLowerCase()) == null)
	            	{
	            		$(this).addClass('hide');
	            		if($(this).closest('.month').find('a').not('.hide').length == 0)
	            		{
	            			$(this).closest('.month').hide()	;
	            		}
	            	}
	            })        
	        });
		}

		instance.fnc.Recent = function()
		{	
			instance.parts.autoPlayControl();

			var galleries = $('.galleries-recent > div').clone();

	        $('.content-window.recent').html(galleries);

	        $('.content-window.recent').slick(instance.slickGalleryOptions);

	         $('.contentRecent .slider-left-icon').click(function()
			{
				$('.content-window.recent').slick('slickPrev');
			});

			$('.contentRecent .slider-right-icon').click(function()
			{
				$('.content-window.recent').slick('slickNext');
			});

	        $("#search.recent").on('keyup', function()
	        {
	            var filterText = this.value;

	            var filtered = galleries.clone().filter(function(index)
                {	                	
                    return $(this).find(".item-gallary")[0].innerText.toLowerCase().match(filterText.toLowerCase()) != null;
                });

	            if(filterText == '')
	            {
	                $('.content-window.recent').slick('unslick').html(galleries).slick(instance.slickGalleryOptions);
	            }else{
	                 $('.content-window.recent').slick('unslick').html(filtered).slick(instance.slickGalleryOptions);
	            }           
	        });
		}

		instance.fnc.Video = function()
		{	
			instance.parts.autoPlayControl();			
		}

		instance.parts = {};

		instance.parts.autoPlayControl = function()
		{			
			$(".autoplay").click(function()
			{
				fotoramaAutoPlay = true;
				$('.stopplay').show();
				$('.autoplay').hide();

				$('.main-gallery .fotorama').data('fotorama').startAutoplay(7000); 
				
				return false;
			});


			$(".stopplay").click(function()
			{
				fotoramaAutoPlay = false;
				$('.stopplay').hide();
				$('.autoplay').show();

				$('.main-gallery .fotorama').data('fotorama').stopAutoplay(); 
				return false;
			});
		}

		return instance;
	})();	

});

