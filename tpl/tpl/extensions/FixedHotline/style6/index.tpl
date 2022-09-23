<link rel="stylesheet" type="text/css" href="{$c_cdn_domain}/tpl/tpl/extensions/FixedHotline/style6/style.css?v={$v}" />

<div class="hotline-fixed hotline-fixed-6 {$hotline_position}">
    <a href="tel:{$hotline}" mypage="" class="call-now" rel="nofollow">
        <div class="mypage-alo-phone">
            <div class="animated infinite zoomIn mypage-alo-ph-circle go"></div>
            <div class="animated infinite pulse mypage-alo-ph-circle-fill go"></div>
            <div class="animated infinite tada mypage-alo-ph-img-circle go"></div>
        </div>
    </a>
	<div class="hotline-fixed-6-text">
        <div class="hotline-fixed-6-text-title">
            {$hotline_title}
	        {$g_functions->display_edit_option_icon('hotline-fixed-text-title', 'text')}
        </div>
        <div class="hotline-fixed-6-text-hotline">
            <a  href="tel:{$hotline}">
        	    {$hotline}
        	    {$g_functions->display_edit_option_icon('fixed-hotline', 'text')}
        	</a>
        </div>
    </div>
     
</div> 

 <style>
    .hotline-fixed-6{
        
    }
    .hotline-fixed-6.bottom_left {
        bottom: {$bottom}px;
        left: {$left}px;
    }
    
    .hotline-fixed-6.bottom_right {
        bottom: {$bottom}px;
        right: {$right}px;
    }
    
    .hotline-fixed-6.top_left {
        top: {$top}px;
        left: {$left}px;
    }
    
    .hotline-fixed-6.top_right {
        top: {$top}px;
        right: {$right}px;
    }
    
    .hotline-fixed-6.bottom_center {
        bottom: {$bottom}px;
    }
</style>