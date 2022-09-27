<div id="header-wrap-3" class="header-wrap">
    <div id="top-bar" class="clearfix v-xs-none v-tx-none">
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
                <div id="main-menu" class="clearfix">
                <div id="header-content-1" class="fl v-col-lg-5 v-col-md-5  v-col-sm-12 v-col-xs-12 v-col-tx-12">
                    <nav class="menu menu-1">
                       {$g_views_BlockArea->display_area('main-menu')}
                    </nav>
                </div>
                
                <div id="logo-wrap" class="fl v-col-lg-2 v-col-md-2">
                   <div id="logo">
                       <a href="{$c_site_url}" class="block">
                            <img src="{$g_functions->get_option('logo')}" alt="" />
                            {$g_functions->display_edit_option_icon('logo', 'image')}
                        </a>
                   </div>
                </div>
                
                <div id="header-content-2" class="fl v-col-lg-5 v-col-md-5 v-col-sm-12 v-col-xs-12 v-col-tx-12">
                    <nav class="menu menu-2">
                       {$g_views_BlockArea->display_area('main-menu2')}
                    </nav>
                </div>
                </div> <!-- End main-menu -->
                
            </div>
        </div> 
    </header>
    <!-- End header -->
</div>
<!-- End header-wrap -->


