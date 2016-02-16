<?

/*

* Template name: About us

*/

get_header();

$post = new WP_QUery(array('p' => 898, 'post_type' => 'page'));

  $post->the_post();?>

<style type="text/css">

  .fotorama__img{

    height: 100%!important;

    width: auto!important;

    top: 0!important;

    margin: 0 auto!important;

    left: 0!important;

  }

  div.scroll_line{

    position: absolute;

    width: 8px;

    border: solid 1px #AAA;

    border-radius: 4px;

    right: 10px;

    height: 100%;

  }

    

  div.scroller{

    position: absolute;

    background: #FB0BFB;

    width: 8px;

    height: 24px;

    min-height: 12px;

    cursor: pointer;

    border-radius: 4px;

    z-index:5;

    top: 0px;

  }

  .wrapper-mans{

    width: 74%;

    margin: 0 auto;

  }

  .wrapp-c-w{

    overflow: hidden;

    margin-top: 5%;

    height: 80%!important;

  }

  .watch-window.about .content-window .team-men:first-child{

    /*opacity: 1;*/

  }

  .watch-window.about .content-window .team-men{

    width: 100%;

   /* opacity: 0;*/

  }

  .watch-window.about .content-window, .watch-window.contact .content-window{

    position: relative;

    overflow: hidden;

  }



  .makeItScrollable_content{

    overflow: hidden;

   }

   .wrapp-arr-down {

    width: 100%;

    padding: 10px 0px;

    cursor: pointer;

    float: left;

    text-align: center;

  }

  @media (max-width: 640px){

    .wrapper-mans{

      width: 74%;

      margin: 0 auto;

      height: auto!important;

      overflow: visible!important;

    }

    div.scroll_line{

      display: none!important;

    }

   .wrapp-arr-down.up{

    display: none;

   }

   .wrapp-arr-down{

    display: none;

   }

  }

  </style>

  <script type="text/javascript">

  // $(function(){

  //   $(".watch-window.about .content-window .team-men").hover(function(){

  //     $(this).animate({opacity:1},200);

  //   },function(){

  //     $(this).animate({opacity:0},200);

  //   });

  // });

  </script>

    <div class="gallery-box main-gallery gallery-box--page-home blur-one-page">

      

      <div class="fotorama" data-autoplay="7000" data-allowfullscreen="true">

        <?=get_the_post_thumbnail($post->ID,'full');?>

      </div>



    </div>



    <div class="contentBox contentPost">

      <div class="watch-window about">

        <div class="header-window">

          <table cellpadding="0" cellspacing="0" border="0">

          <tr>

          <td class="left-header-window">

            

          </td>

          <td class="center-header-window">

            <h1><? the_title()?></h1>

          </td>

          <td class="right-header-window"></td>

          </tr>

          </table>

        </div>

        <div class="wrapp-c-w">

        <div class="content-window" id="contaner-scroll">

        

          <? the_content()?>          

          <hr>

          <h1>Our Team</h1>



          <!--div class="wrapp-arr-down up">

            <a href="#" class="goto-next"><img src="<?=TPL?>/img/arrow-up.png"></a>

          </div-->

          <div class="verical-sliderscr" >

<div class="wrapper-mans">



            <? 

            $abouts = simple_fields_fieldgroup('about');



            foreach($abouts as $about){?>



              <div class="team-men" data-sr="enter bottom over 1s and move 65px">

                <img src="<?=$about['Photo']['image_src']['thumbnail'][0]?>" width="14%" height="auto">

                <span><?=$about['f_name']?></span>

                <p><?=$about['dscr']?></p>

              </div>

            <?}?>

            </div>

            </div>

          </div>

          <!--div class="wrapp-arr-down">

            <a href="#" class="goto-prev"><img src="<?=TPL?>/img/arrow-down.png"></a>

          </div-->

        </div>

      </div>

         <script type="text/javascript">

$(document).ready(function(){

		$('.verical-sliders-go').slick({

  infinite: true,

  slidesToShow: 3,

  slidesToScroll: 3,

vertical: true

});

});

    function sliderUp()

    {

      $('.verical-slider').slick('slickNext');

    }



    function sliderDown()

    {

      $('.verical-slider').slick('slickPrev');

    }



    </script> 

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



            <script type="text/javascript">

            $(function()

            {

                Router.fnc.About();

            });

            </script>   



  </div> 

  <script type="text/javascript">

    $(".wrapp-c-w").makeItScrollable({

        containerElementaryUnit: '.team-men',

        stepSize: [0.1, 'units'],

      });

  </script>

  <?get_footer()?>