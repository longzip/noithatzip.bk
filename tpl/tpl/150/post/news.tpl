{include file='../header.tpl'}
<style>
    #slide, #video-replace-slide {
        display: none;
    }
</style>
<div class="middle v-wrap-full" id="post-middle">

    <div class="post-content">
        <div id="wrap-post-content">
            <div class="">
                <div class="">
                    <div class="">
                        <div class="dieu-huong  bread-crumb">
                            {$g_functions->display_bread_crumb()}
                        </div>
                        <div class="main-content">
                            <h1 class="page-h1" id="news-page-h1">{$post_info.title}</h1>
                            <div id="post-content" style="padding: 0;">
                                {$post_info.content}
                                <span class="clear"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <span class="clear"></span>
        <div class="more-detail">
	        <div class="form-content">
	            {$g_views_BlockArea->display_area('more-detail')}
	        </div>
	    </div>
	        
        <span class="clear"></span>
        <div class="relative-post">
            <h3 class="page-h1">Tin liên quan</h3>
            {$posts = $g_functions->get_relative_posts(['field'=>'*', 'posts_per_page'=>4, 'filter_by'=>'category', 'order'=>'ORDER BY time_update DESC'])}
            {include file='../box-relative-post.tpl'}
        </div>

    </div>
    <span class="clear"></span>

</div>


<span class="clear"></span>
{include file='../footer.tpl'}