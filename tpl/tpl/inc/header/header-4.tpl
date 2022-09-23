<div id="header-wrap-4" class="header-wrap">
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
    
    <header id="header" class="clearfix fixed-on-scroll">
        <div id="header-inner" class="v-wrap-full">
            <div class="header-inner-wrap clearfix">
                
                <div id="logo-wrap" class="fl v-col-lg-2 v-col-md-2 v-col-sm-9 v-col-tx-12">
                    <div id="logo" class="fl v-tx-text-align-center v-xs-text-align-center v-sm-text-align-center v-tx-float-none v-xs-float-none v-sm-float-none">
                        <a href="{$c_site_url}">
                            <img src="{$g_functions->get_option('logo')}" alt="" />
                            {$g_functions->display_edit_option_icon('logo', 'image')}
                        </a>
                    </div>
                </div> <!-- .col -->
                
                <div id="header-content" class="fr v-col-lg-10 v-col-md-10 v-col-sm-3 v-col-xs-12 v-col-tx-12">
                    <nav id="main-menu" class="fl">
                        {$g_views_BlockArea->display_area('main-menu')}
                    </nav>
                    <!-- End main-menu -->
                    
                    <div id="header-hotline" class="fr clearfix   v-tx-none">
                        <div class="header-hotline-wrap clearfix">
                            <div class="header-hotline-icon fl">
                                <a href="tel:{$g_functions->get_option('header-hotline-text-number')}" class="fa fa-phone"></a>
                            </div>
                            
                            <div class="header-hotline-text fr">
                                <div class="header-hotline-text-title">
                                    {$g_functions->get_option('header-hotline-text-title')}
                                    {$g_functions->display_edit_option_icon('header-hotline-text-title', 'text')}
                                </div>
                                <div class="header-hotline-text-number">
                                    <a href="tel:{$g_functions->get_option('header-hotline-text-number')}">{$g_functions->get_option('header-hotline-text-number')}</a>
                                    {$g_functions->display_edit_option_icon('header-hotline-text-number', 'text')}
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- .col -->
                
            </div>
        </div> 
    </header>
    <!-- End header -->
</div>
<!-- End header-wrap -->


