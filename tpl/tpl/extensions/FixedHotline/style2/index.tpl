<link rel="stylesheet" type="text/css" href="{$c_cdn_domain}/tpl/tpl/extensions/FixedHotline/style2/style.css?v={$v}" />



<div class="hotline-fixed hotline-fixed-2  {$hotline_position} clearfix">
    <div class="hotline-fixed-2-icon">
        <i class="fa fa-phone"></i>
    </div>
    
	<div class="hotline-fixed-2-text">
        <div class="hotline-fixed-2-text-title">
            {$hotline_title}
            {$g_functions->display_edit_option_icon('hotline-fixed-text-title', 'text')}
        </div>
        <div class="hotline-fixed-2-text-hotline">
            <a href="tel:{$hotline}" >
            {$hotline}
            {$g_functions->display_edit_option_icon('fixed-hotline', 'text')}
            </a>
        </div>
    </div>
    
</div>  


<style>
    .hotline-fixed-2{
        background: {$color1};    
        background: -webkit-linear-gradient(left, {$color1} , {$color2});
        background: -o-linear-gradient(right, {$color1}, {$color2});
        background: -moz-linear-gradient(right, {$color1}, {$color2});
        background: linear-gradient(to right, {$color1} , {$color2});
    
    }
    .hotline-fixed-2.bottom_left {
        bottom: {$bottom}px;
        left: {$left}px;
    }
    
    .hotline-fixed-2.bottom_right {
        bottom: {$bottom}px;
        right: {$right}px;
    }
    
    .hotline-fixed-2.top_left {
        top: {$top}px;
        left: {$left}px;
    }
    
    .hotline-fixed-2.top_right {
        top: {$top}px;
        right: {$right}px;
    }
    
    .hotline-fixed-2.bottom_center {
        bottom: {$bottom}px;
    }

</style>
 
	    