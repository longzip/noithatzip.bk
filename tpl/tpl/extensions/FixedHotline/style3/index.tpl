<link rel="stylesheet" type="text/css" href="{$c_cdn_domain}/tpl/tpl/extensions/FixedHotline/style3/style.css?v={$v}" />

<div class="hotline-fixed hotline-fixed-3 {$hotline_position}">
	<div class="hotline-fixed-3-text">
        <div class="hotline-fixed-3-text-title">
            <a  href="tel:{$hotline}">
        	    {$hotline_title}
        	    {$g_functions->display_edit_option_icon('hotline-fixed-text-title', 'text')}
        	</a>
        </div>
        <div class="hotline-fixed-3-text-hotline">
            <a  href="tel:{$hotline}">
        	    {$hotline}
        	    {$g_functions->display_edit_option_icon('fixed-hotline', 'text')}
        	</a>
        </div>
    </div>
</div>  

 


<style>
    .hotline-fixed-3.bottom_left {
        bottom: {$bottom}px;
        left: {$left}px;
    }
    
    .hotline-fixed-3.bottom_right {
        bottom: {$bottom}px;
        right: {$right}px;
    }
    
    .hotline-fixed-3.top_left {
        padding-left: 45px;
        top: {$top}px;
        left: {$left}px;
    }
    
    .hotline-fixed-3.top_right {
        top: {$top}px;
        right: {$right}px;
    }
    
    .hotline-fixed-3.bottom_center {
        bottom: {$bottom}px;
    }
</style>