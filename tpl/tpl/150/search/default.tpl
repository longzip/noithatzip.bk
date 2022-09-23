{include file='../header.tpl'}

<div id="bread-crumb" class="v-full-width">
 
</div>

<div class="v-full-width middle">
    <section class="v-wrap-full" id="middle-content" style="margin-top: 0;">
        <div class="inner">
            <div id="sidebar" class="fl v-col-lg-3 v-col-md-4 v-col-sm-6 v-xs-none v-tx-none">
                <div class="inner v-lg-pr-20 v-md-pr-20 v-sm-pr-20">
                      {$g_views_BlockArea->display_area('sidebar')}
                </div>
            </div>
            
            <div class="fr v-col-lg-9 v-col-md-8 v-col-sm-6 v-col-xs-12 v-col-tx-12" id="col2">
                <div class="" style="padding: 15px;">
                <h1 class="page-h1">Kết quả tìm kiếm cho "{$smarty.get.s}"</h1>
                <div class="archive">
                   {include file='../box2.tpl'}
                    <span class="clear"></span>
                </div>
                <span class="clear"></span>
                 {$g_functions->display_pagination()}
                </div>
            </div>
            <span class="clear"></span>
        </div>
    </section>
</div>

 
 
<span class="clear"></span>
{include file='../footer.tpl'}