<div id="header-wrap-7" class="header-wrap">
    <div id="top-bar" class="clearfix v-xs-none v-tx-none">
        <div id="top-bar-inner" class="v-wrap-full">
            <div class="top-bar-inner-wrap clearfix">
                <div class="fl top-content-col top-content-col1 v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-12 v-col-tx-12">
                    
                    <div class="top-content top-content-left clearfix">
                        {$g_views_BlockArea->display_area('top-content-left')}
                    </div>
                    
                </div>
                
                <div class="fr top-content-col top-content-col2 v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-12 v-col-tx-12">
                    
                    <div class="top-content top-content-right clearfix">
                        {$g_views_BlockArea->display_area('top-content-right')}
                        <div class="clear"></div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- End top-bar -->
    
    <div class="clear"></div>
    
    <header id="header" class="clearfix">
        <div id="header-inner" class="v-wrap-full">
            <div class="header-inner-wrap clearfix">
                
                <div id="logo-wrap" class="fl v-col-lg-2 v-col-md-2 v-col-sm-9 v-col-xs-6 v-col-tx-12">
                    <div id="logo" class="fl v-tx-text-align-center v-tx-float-none">
                        <a href="{$c_site_url}">
                            <img src="{$g_functions->get_option('logo')}" alt="" />
                            {$g_functions->display_edit_option_icon('logo', 'image')}
                        </a>
                    </div>
                </div> <!-- .col -->
                
                <div id="header-content" class="fr v-col-lg-10 v-col-md-10 v-col-sm-3 v-col-vs-6 v-col-tx-12">
                    <div class="header-banner fl v-col-lg-9 v-col-md-9 v-col-sm-9 v-col-vs-8 v-col-tx-12">
                        {$g_views_BlockArea->display_area('header-banner')}
                    </div>
                    
                    <div id="header-more-option" class="fl v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-vs-4 v-col-tx-12">
                       {$g_views_BlockArea->display_area('header-more-option')}
                    </div>
                   
                    <!-- End main-menu -->
                </div> <!-- .col -->
                
            </div>
        </div> 
        
        <span class="clear"></span>
        <div id="navigation" class="clearfix">
            <div id="navigation-inner" class="v-wrap-full">
                <div class="navigation-inner-wrap clearfix">
                     <nav id="main-menu" class="fl">
                        {$g_views_BlockArea->display_area('main-menu')}
                    </nav>
                    <div class="near-main-menu clearfix">
                        {$g_views_BlockArea->display_area('near-main-menu')}
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End header -->
</div>
<!-- End header-wrap -->


