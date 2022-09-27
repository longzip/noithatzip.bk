 <div id="header-wrap-1" class="header-wrap">
    <div id="top-bar" class="clearfix v-xs-none v-tx-none search-form-style-1">
        <div id="top-bar-inner" class="v-wrap-full">
            <div class="top-bar-inner-wrap clearfix">
                <div class="fl top-content-col top-content-col1 v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-12 v-col-tx-12">
                    <div class="top-content top-content-left clearfix">
                        {$g_views_BlockArea->display_area('top-content-left')}
                    </div>
                </div>
                
                <div class="fl top-content-col top-content-col2 v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-12 v-col-tx-12">
                    <div class="top-content top-content-right clearfix">
                        {$g_views_BlockArea->display_area('top-content-right')}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- End top-bar -->
    
    <header id="header" class="clearfix">
        <div id="header-inner" class="v-wrap-full">
            <div class="header-inner-wrap clearfix">
                <div id="logo-wrap" class="fl v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-sx-12 v-col-tx-12 v-xs-float-none v-tx-float-none">
                    <div id="logo" class="v-xs-text-align-center v-tx-text-align-center">
                        <a href="{$c_site_url}">
                            <img src="{$g_functions->get_option('logo')}" alt="" />
                            {$g_functions->display_edit_option_icon('logo', 'image')}
                        </a>
                    </div>
                </div>
                
                <div id="header-content" class="fl v-col-lg-9 v-col-md-9 v-col-sm-9 v-col-sx-12 v-tx-none">
                    <div class="header-banner">
                        {$g_views_BlockArea->display_area('header-banner')}
                    </div>
                </div>
            </div>
        </div> 
    </header>
    
    <div id="navigation" class="clearfix">
        <div id="navigation-inner" class="v-wrap-full">
            <div class="navigation-inner-wrap clearfix">
                <div class="fl nav-col v-col-lg-12 v-col-md-12 v-col-sm-12 v-col-sx-12 v-col-tx-12">
                    
                    <nav id="main-menu" class="clearfix">
                        {$g_views_BlockArea->display_area('main-menu')}
                    </nav>
                    
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End header-wrap -->


