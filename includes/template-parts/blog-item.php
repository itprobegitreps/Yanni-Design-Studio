<div class="wrapp-one-rev">
    <div class="one-rev">
        <div class="img-rev">
            <a href="<? the_permalink()?>">
                <img src="<?=CUtil::thumbUrl()?>">
            </a>
        </div>       
            <div class="head-rev">
                <span><a href="<? the_permalink()?>"><? the_title()?></a></span>
                <span class="date"><? the_date('F n\t\h Y')?></span>
                <div class="social-icons">
                    <? CUtil::getSocials(get_the_permalink(), $post->post_name)?>                 
                </div>
            </div>
        <div class="blog-post-excerpt"><? the_excerpt();?></div>
    </div>
</div>  