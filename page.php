<?php
/*
Template name: Blog page
*/?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Yanni Design Studio has been creating exceptional events for over 20 years.  With the assistance of our multi talented design team, carpenter-craftsmen and seamstresses, we produce unique, custom designed, memorable events that you and your guests will never forget!"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="wedding design studio, wedding flowers, wedding table design, wedding table decorations, wedding room lighting, wedding drapery, indian wedding decor, uniqe jewish wedding  ceremony decor, christian wedding decor, wedding mandap, wedding ceremony flowers, hindy wedding decor, wedding flowers in Chicago, wedding flowers chicagoland, south asian wedding flowers decor, southasian wedding decorations, indian wedding favors, jewish wedding favors, wedding centerpieces, wedding floral arrangement, yanni decor, yanni chicago, wedding decorations chicago, backdrop drapery, best wedding decoration pictures, chicago wedding decorator, indian wedding decorations Chicago, wedding decoratotor Chicago il, wedding flower decoration, full service design decor company, wedding decor indiana, wedding florist indiana, wedding decorations indiana, wedding decor michigan, wedding florist michigan, wedding decorations michigan, wedding decor georgia, wedding florist georgia, wedding decorations georgia, wedding decor ohio, wedding florist ohio, wedding decorations ohio, wedding decor tennessee, wedding florist tennessee, wedding decorations tennessee, wedding decor missouri, wedding florist missouri, wedding decorations missouri, wedding decor kentucky, wedding florist kentucky, wedding decorations kentucky, wedding decor wisconsin, wedding florist wisconsin, wedding decorations wisconsin,  extravagant wedding flowers, hi-end wedding decor, high-class wedding floral arrangements, luxurious wedding decorator, expensive floral arrangements, exclusive wedding florist, celebrity wedding florist, iconic wedding design, sensational floral, enchanting floral centerpieces, captivating decorations and floral, exceptional wedding decor, imaginative wedding decorator, inspired floral, superior florist, top of the line florist, glamorous floral and wedding decor"/>
<meta name="msvalidate.01" content="70D607ECA752C3D85872E06346068E72" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta property="og:title" content="Welcome to visit our new web-site!"/>
<meta property="og:site_name" content="Yanni Design Studio | The official YDS web-site"/>
<meta property="og:image" content="http://yannidesignstudio.com/index_imgs/yanni-design-studio-0.jpg"/>
<meta property="og:site_description" content="Yanni Design Studio 2014 - Originality and innovative designs is our goal in creating special events for our clients."/>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-45915223-1', 'yannidesignstudio.com');
  ga('send', 'pageview');
</script>
    <title>Yanni Design Studio - Wedding Flowers and Decorations Chicago - <?php echo the_title(); ?></title>

    <!-- Bootstrap -->
    <link href="<?php bloginfo('template_directory'); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php bloginfo('template_directory'); ?>/assets/css/stylle.css" rel="stylesheet">
    <link href="<?php bloginfo('template_directory'); ?>/assets/css/jquery-ui.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<?php get_footer(); ?>
<div class="content">
<div class="sidebar"><?php get_sidebar(); 
	wp_reset_query();?>
</div>
<div class="posts">
	<div class="title">
			<?php echo the_title(); ?>
			<li class="icon-date"><?php echo get_the_date( get_option('date_format') ); ?></li>
	</div>
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="txt">
      <?php echo the_content(); ?>
    </div>  
    <center><p><span>
  <a data-toggle="tooltip" data-placement="top" data-original-title="Facebook - Share this page on Facebook" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=http://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>"><i class="fa fa-facebook-square fa-2x"></i></a>
</span>
<span>
  <a data-toggle="tooltip" data-placement="top" data-original-title="Twitter - Tweet about this page" target="blank" href="http://twitter.com/share?text=<?=the_title("","", false)?>&url=http://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>"><i class="fa fa-twitter-square fa-2x"></i></a>
</span>
<span>
    <a data-toggle="tooltip" data-placement="top" data-original-title="Pinterest - Pin this page" href="//www.pinterest.com/pin/create/button/?url=<?=urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])?>&description=<?=urlencode(the_title("","", false) .' '. the_excerpt("","", false))?>" data-pin-do="buttonPin" data-pin-config="none" data-pin-color="white"><i class="fa fa-pinterest-square fa-2x"></i></a>
<!-- Please call pinit.js only once per page -->
</span>
                 </p></center>  
	<?php endwhile; ?>
</div>	

</div>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php bloginfo('template_directory'); ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/assets/js/script.js"></script>
<div style="clear:both"></div>
<?php get_header(); ?>
</body>

</html>