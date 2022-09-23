{include file='../header.tpl'}

<script src="{$c_fontend_template_url}/js/showRoom.js?v={$v}"></script>
<script src="{$c_cdn_domain}/inc/js/ecommerce.js"></script>
<link rel="stylesheet" type="text/css" href="{$c_fontend_template_url}/css/showRoom.css?v={$v}" media="all"/>

<div class="show-room clearfix">
    <div class="showroom-inner v-wrap-full">
        <div class="showroom-title">
            <h2>hệ thống showroom</h2>
        </div>
        <div class="showRoomContent">
          <div class="showRoomContentInner">
            <div class="showRoomCol1 fl">
              {$g_views_BlockArea->display_area('defaultShowRoom')}
            </div>
            <div class="showRoomCol2 fl">
              {$g_functions->advanced_search_by_field(['field'=>'khu_vuc'])}
              <div class="listShowRoom"></div>
            </div>

          </div>
        </div>
    </div>
</div>
<span class="clearfix"></span>
{include file='../footer.tpl'}
