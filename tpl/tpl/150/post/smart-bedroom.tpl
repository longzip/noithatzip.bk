{include file='../header.tpl'}
<div class="smart-bedroom clearfix">
    <div class="v-wrap-full">
        {$g_functions->block_area_tabs('smart-bedroom', 'click')}
        <div class="cart-smartBedroom" ><span class="item-action view-cart inline">Đặt vào giỏ hàng</span></div>
        <div class="instruct">
            {$g_views_BlockArea->display_area('instruct')}
            <div class="btn-start">Bắt đầu</div>
        </div>
    </div>
    
</div>
<span class="clear"></span>
        <div class="relative-post v-wrap-full">
            <h3 class="page-h1">Tin liên quan</h3>
            {$posts = $g_functions->get_relative_posts(['field'=>'*', 'posts_per_page'=>4, 'filter_by'=>'category', 'order'=>'ORDER BY time_update DESC'])}
            {include file='../box-relative-post.tpl'}
        </div>
<div id="loader" style="display:none"></div>
{include file='../footer.tpl'}
