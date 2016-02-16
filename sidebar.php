<div>
	<label>
		<span class="title screen-reader-text"><?php echo _x( 'Search:', 'label' ) ?></span><br/>
		<input type="search" id="inputsearch" class="search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
	</label>
</div>
<hr />  
<div id="categories" class="title"><?php _e('Topics:'); ?></div>
<div id="search">
<?php 

if (the_category_ID(false) == 20) {
  query_posts(array( 'posts_per_page' => -1, 'order' => 'desc', 'cat' => 20 ));
} else {
  query_posts(array( 'posts_per_page' => -1, 'order' => 'desc', 'cat' => -20 ));
}
$dat = '';
	while ( have_posts() ) : the_post(); ?>
		<div class="txt">
		<?php $new_d = the_date('F Y', '<b>', '</b>', FALSE);
		if ($dat != $new_d) {
			$dat = $new_d;
			echo $dat;
			echo ":<br/>";
		}?>
			<span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
		</div>
<?php endwhile; ?>
</div>
<hr />
<div class="sociall">
<a data-toggle="tooltip" data-placement="top" data-original-title="Like Us on Facebook" href="https://www.facebook.com/YanniDesignStudio"><i class="fa fa-facebook-square fa-2x"></i>
<a data-toggle="tooltip" data-placement="top" data-original-title="Subscribe to our YouTube Channel" href="https://www.youtube.com/channel/UCvgoMaZu4gopBahT3JRibWA"><i class="fa fa-youtube-square fa-2x"></i></a>
<a data-toggle="tooltip" data-placement="top" data-original-title="Follow us on Pinterest" href="http://www.pinterest.com/yannidesign/"><i class="fa fa-pinterest-square fa-2x"></i>
<a data-toggle="tooltip" data-placement="top" data-original-title="Follow us on Twitter" href="https://twitter.com/YanniDesign"><i class="fa fa-twitter-square fa-2x"></i></a>
</div>  
<div style="clear:both"></div>
<hr />
<style type="text/css">
  .sociall a{color: black; margin-right: 15px}
</style>
<script type="text/javascript">
	window.onload = function() {
//onload begin
   var inp = document.getElementById('inputsearch');
  var find = function() {
//find begin
    var parent = document.getElementById('search');
    var divs = parent.getElementsByTagName('span');
    len = divs.length;
    for (var i = 0; i < len; i++) {
//for begin
searchtext = parent.getElementsByTagName('a');
     re='.*?';
     p = new RegExp(re+inp.value,["i"]);
     m = p.exec(searchtext[i].innerHTML);
     if (m == null && inp.value != '') {
       divs[i].style.display = 'none';
           
     } else if (divs[i].style.display != 'block') {
       divs[i].style.display = 'block';
     }
   }
//for end        
 }
//find end
 inp.onkeyup = function() {
   find();
 }
}
//onload end
</script>