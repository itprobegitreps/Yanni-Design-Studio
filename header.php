<? global $wp_body_class;?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><? wp_title()?></title>
  <? wp_head()?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="<?=$wp_body_class?>">



  <div class="l-container">

    

    <div class="l-header">

      <div class="nav-header">

	<form style="position:absolute;"><input type="button" onClick="history.go(-1)" class="backbutton" style="background-color: transparent;border: 0;"></form>

        <a href="#" class="opensearch"></a>

        <div class="logo mob-logo"><a href="/"><img src="<?=TPL?>/img/logo.png" alt="Yanni Design Studio Logo"></a></div>

        <a href="#" class="mobnav"></a>

        <ul>

          <li class="select"><a data-href="Design" >Design Gallery</a></li>

          <li><a data-href="Venue">Venue Gallery</a></li>

          <li><a data-href="Recent" >Recent Events</a></li>

          <li><a data-href="" class="native"  href="/video-gallery">Video Gallery</a></li>

          <div onclick="window.location = '/'" class="logo"><a href="/"><img src="<?=TPL?>/img/logo.png" alt="Yanni Design Studio Logo"></a></div>

          <li><a data-href="" class="native" href="/about-us">About Us</a></li>

          <li><a data-href="" class="native" href="/contacts">Contact Us</a></li>

          <li><a data-href="" class="native" href="/reviews">Reviews</a></li>

          <li><a data-href="" class="native" href="/blog">Blog</a></li>

        </ul>

      </div>

    </div>