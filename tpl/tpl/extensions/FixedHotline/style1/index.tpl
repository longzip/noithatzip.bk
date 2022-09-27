<link rel="stylesheet" type="text/css" href="{$c_cdn_domain}/tpl/tpl/extensions/FixedHotline/style1/style.css?v={$v}" />
<script src="{$c_cdn_domain}/tpl/tpl/extensions/FixedHotline/style1/script.js?v={$v}"></script>

<div class="hotline-fixed hotline-fixed-1 {$hotline_position}"  >
	<img class="animate-flicker " src="{$c_cdn_domain}/images/hotline1.png" />
	<a  href="tel:{$hotline}">
	    {$hotline}
	    {$g_functions->display_edit_option_icon('fixed-hotline', 'text')}
	</a>
</div>


<style>
    .hotline-fixed-1{
        background: {$color1};    
        background: -webkit-linear-gradient(left, {$color1} , {$color2});
        background: -o-linear-gradient(right, {$color1}, {$color2});
        background: -moz-linear-gradient(right, {$color1}, {$color2});
        background: linear-gradient(to right, {$color1} , {$color2});
    
    }
    .hotline-fixed-1.bottom_left {
        bottom: {$bottom}px;
        left: {$left}px;
    }
    
    .hotline-fixed-1.bottom_right {
        bottom: {$bottom}px;
        right: {$right}px;
    }
    
    .hotline-fixed-1.top_left {
        top: {$top}px;
        left: {$left}px;
    }
    
    .hotline-fixed-1.top_right {
        top: {$top}px;
        right: {$right}px;
    }
    
    .hotline-fixed-1.bottom_center {
        bottom: {$bottom}px;
    }
</style>