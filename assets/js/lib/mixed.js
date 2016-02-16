$(document).ready(function ()
{
    // window.sr = new scrollReveal({
    //     reset: true,
    //     move: '50px',
    //     mobile: true
    //   });

    $('[data-toggle="tooltip"]').tooltip();
});


$(function ()
{
    $(".mobnav").toggle(function ()
        {
            $(".nav-header ul").css("display", "block");
            return false;
        },
        function ()
        {
            $(".nav-header ul").css("display", "none");
            return false;
        });

    $(".nav-header ul li a").click(function ()
    {
        if ($('.mobnav').css('display') == 'block')
        {
            var obj = $(this);
            if (obj.parent('li').parent('ul').css('display') == 'block')
            {
                //obj.parent('li').parent('ul').css('display','none');
                $(".mobnav").trigger('click');
            }
        }
        else
        {
            $(".nav-header ul").css("display", "block");
        }
    });
    $(".opensearch").toggle(function ()
        {
            $(".watch-window .left-header-window input").css("display", "block");
            $(".header-window h1").css("opacity", "0");
            $()
            return false;
        },
        function ()
        {
            $(".watch-window .left-header-window input").css("display", "none");
            $(".header-window h1").css("opacity", "1");
            return false;
        });

    if ($(window).width() <= 640)
    {
        if ($(".watch-window.about").length >= 1 || $(".watch-window.contact").length >= 1)
            $(".opensearch").css("display", "none");
        var countbl = $(".blog-page").length;
      
        if (countbl >= 1)
            $(".opensearch").css("display", "block");

        $("*").click(function ()
        {
            if ($(".watch-window.about").length >= 1 || $(".watch-window.contact").length >= 1)
                $(".opensearch").css("display", "none!important");
            var countbl = $(".blog-page").length;
          
            if (countbl >= 1)

                $(".opensearch").css("display", "block");

            var flagdis = 0;

            $(".contentBox").each(function ()
            {
                var tecdis = $(this).css("display");
                var tecclass = $(this).attr("class");
              
                if (tecdis == "none" || ((tecdis == "block") && (tecclass == "contentBox contentPost")))
                {

                }else
                {
                    flagdis = 1;
                }

                if (flagdis == 1)
                {
                    $(".opensearch").css("display", "block");
                }

                else
                    $(".opensearch").css("display", "none");
            });
        });
    }

    var forback = $(".forbackb").length;

  if (forback >= 1)
  {
        $(".backbutton").css("display", "block");
  }

});

   $(function()
   {
    $(".wrapp-rev").makeItScrollable(
    {
      containerElementaryUnit: '.month a',
      stepSize: [0.5, 'units'],
    });
   });