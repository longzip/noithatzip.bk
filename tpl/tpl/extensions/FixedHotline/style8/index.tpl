<link rel="stylesheet" type="text/css" href="{$c_cdn_domain}/tpl/tpl/extensions/FixedHotline/style8/style.css?v={$v}" />


<div class="hotline-fixed hotline-fixed-8 {$hotline_position}" >
    <div id="s-oneclick" class="s-mod">
        <div class="oneclick-phone oneclick-show oneclick-popup" id="oneclick-phone">
            <a href="tel:{$hotline}" class="group1 cboxElement">
                <div class="oneclick-ph-circle"></div>
                <div class="oneclick-ph-img-circle"></div>
            </a>
        </div>
    </div>
    <a  class="hotline-fixed-8-text" href="tel:{$hotline}"  >
      <span>{$hotline}{$g_functions->display_edit_option_icon('fixed-hotline', 'text')}</span>
    </a>
</div>

 
	
	
<style>
     
    .hotline-fixed-8.bottom_left {
        bottom: {$bottom}px;
        left: {$left}px;
    }
    
    .hotline-fixed-8.bottom_right {
        bottom: {$bottom}px;
        right: {$right}px;
    }
    
    .hotline-fixed-8.top_left {
        top: {$top}px;
        left: {$left}px;
    }
    
    .hotline-fixed-8.top_right {
        top: {$top}px;
        right: {$right}px;
    }
    
    .hotline-fixed-8.bottom_center {
        bottom: {$bottom}px;
    }
</style>

