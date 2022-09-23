<link rel="stylesheet" type="text/css" href="{$c_cdn_domain}/tpl/tpl/extensions/FixedHotline/style7/style.css?v={$v}" />

<div class="hotline-fixed hotline-fixed-7 {$hotline_position} quick-alo-phone quick-alo-green quick-alo-show"    >
  <a href="tel:{$hotline}" title="">
      <div class="quick-alo-ph-circle"></div>
      <div class="quick-alo-ph-circle-fill"></div>
      <div class="quick-alo-ph-img-circle"></div>
  </a>
  <a  class="hotline-fixed-7-text" href="tel:{$hotline}"  >
      <span>
      {$hotline}
	  {$g_functions->display_edit_option_icon('fixed-hotline', 'text')}
      </span>
  </a>
   
</div>

<style>
    .hotline-fixed.bottom_left {
        bottom: {$bottom}px;
        left: {$left}px;
    }
    
    .hotline-fixed.bottom_right {
        bottom: {$bottom}px;
        right: {$right}px;
    }
    
    .hotline-fixed.top_left {
        top: {$top}px;
        left: {$left}px;
    }
    
    .hotline-fixed.top_right {
        top: {$top}px;
        right: {$right}px;
    }
    
    .hotline-fixed.bottom_center {
        bottom: {$bottom}px;
    }

</style>
