$(document).ready(function() {

	$('.menu-title').click(function(e){
		var click = $(this).parent();
		$.each($('.menu-stripe').children(), function(index, val) {
			 if ($(this).find('.menu-content').hasClass('open') && val != click[0]) {
			 	$(this).find('.menu-content').slideUp();
			 	$(this).find('.menu-content').removeClass('open');
			 };
		});
		if ($(this).parent().find('.menu-content').hasClass('open')) {
			$(this).parent().find('.menu-content').slideUp();
			$(this).parent().find('.menu-content').removeClass('open');
		} else{
			$(this).parent().find('.menu-content').slideDown();
			$(this).parent().find('.menu-content').addClass('open');
		};
		
		
    });   

});
   


// $(document).ready(function() {

// $('.menu-strip-about-us').click(function(){
// $(this).toggleClass('opened').toggleClass('closed').next().slideToggle(); 
// 		$('.design-gallery-content').hide();
// 		$('.venue-gallery-content').hide();
// 		$('.social-media-content').hide();
// 		$('.contact-us-content').hide();
//         });});
	    
// $(document).ready(function() {

// $('.menu-strip-design-gallery').click(function(){
// $(this).toggleClass('opened').toggleClass('closed').next().slideToggle(); 
// 		$('.about-us-content').hide();
// 		$('.venue-gallery-content').hide();
// 		$('.social-media-content').hide();
// 		$('.contact-us-content').hide();
//         });});
        
// $(document).ready(function() {

// $('.menu-strip-venue-gallery').click(function(){
// $(this).toggleClass('opened').toggleClass('closed').next().slideToggle(); 
// 		$('.about-us-content').hide();
// 		$('.design-gallery-content').hide();
// 		$('.social-media-content').hide();
// 		$('.contact-us-content').hide();
//         });});
        
// $(document).ready(function() {

// $('.menu-strip-social-media').click(function(){
// $(this).toggleClass('opened').toggleClass('closed').next().slideToggle(); 
// 		$('.about-us-content').hide();
// 		$('.design-gallery-content').hide();
// 		$('.contact-us-content').hide();
// 		$('.venue-gallery-content').hide();
//         });});
        
        
// $(document).ready(function() {        

// $('.menu-strip-contact-us').click(function(){
// $(this).toggleClass('opened').toggleClass('closed').next().slideToggle(); 
// 		$('.about-us-content').hide();
// 		$('.design-gallery-content').hide();
// 		$('.venue-gallery-content').hide();
// 		$('.social-media-content').hide();
//         });});
        
// $(document).ready(function() {

// $('.menu-strip-recent-gallery').click(function(){
// 		$('.about-us-content').hide();
// 		$('.design-gallery-content').hide();
// 		$('.contact-us-content').hide();
// 		$('.venue-gallery-content').hide();
// 		$('.social-media-content').hide();
//         });});