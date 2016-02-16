jQuery( document ).ready(function() {
  jQuery('.navbar-collapse').removeClass('collapse').addClass('in collapse').css("height","auto"); 
jQuery('.cycle-slideshow').cycle('pause');	
jQuery('.play_c').show();  
    jQuery('.pause_c').hide();  
});
window.onload = function(){
jQuery('.cycle-slideshow').cycle('resume');
jQuery('.pause_c').show(); 
    jQuery('.play_c').hide(); 
}
function playC () {
	jQuery('.cycle-slideshow').cycle('resume'); 
    jQuery('.pause_c').show(); 
    jQuery('.play_c').hide();   
}
function pauseC () {
	jQuery('.cycle-slideshow').cycle('pause');
    jQuery('.play_c').show();  
    jQuery('.pause_c').hide();  
}