<div id="header-wrap-8" class="header-wrap">
    <!-- Top -->
    <div id="top-bar">
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
    
    <header id="header">
        <div id="header-inner" class="v-wrap-full">
            <div class="header-inner-wrap clearfix">
                <div id="logo-wrap" class="fl v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-sx-12 v-col-tx-12 v-xs-float-none v-tx-float-none">
                    <div id="logo" class="v-xs-text-align-center v-tx-text-align-center">
                        <a href="{$c_site_url}">
                            <img src="{$g_functions->get_option('logo')}" alt="" />
                            {$g_functions->display_edit_option_icon('logo', 'image')}
                        </a>
                    </div>
                </div> <!-- #logo wrap -->
                
                <div id="header-content" class="fl v-col-lg-9 v-col-md-9">
                    
                    <div class="fr v-col-lg-3 v-col-md-3">
                        <div id="cart-box" class="view-cart">
                            <div class="heading-cart">
                                <a href="#">
                                    <span class="cart_num" id="cart-total">
                                        <span class="cartCount  count_item_pr">0</span> 
                                        <span>Sản phẩm</span>
                                    </span>
                                    <span class="cart_bg">
                                        
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div> <!-- col -->
                    
                    <div class="fr v-col-lg-9 v-col-md-9">
                        <nav id="main-menu" class="clearfix">
                            {$g_views_BlockArea->display_area('main-menu')}
                        </nav>
                    </div>
                    
                </div> <!-- #header-content -->
                
            </div> <!-- .header-inner-wrap -->
        </div> <!-- #header-inner -->
    </header>
    
    <div id="header-menu-mega">
        <div id="header-menu-mega-inner" class="v-wrap-full clearfix">
            <div class="fl header-menu-mega-col header-menu-mega-col1 v-col-lg-3 v-col-md-3">
                <nav id="mega-menu">
                    <div class="title_menu">
                        {$g_functions->display_edit_option_icon('title-menu', 'html')}
                        {$g_functions->get_option('title-menu')}
                    </div>
                    {$g_views_BlockArea->display_area('mega_menu')}
                </nav>
            </div>
            
            <div class="fl header-menu-mega-col header-menu-mega-col2 v-col-lg-6 v-col-md-6">
                <div class="header_search search_form">
                    {$g_functions->search_form()}
                </div>
            </div>
            
            <div class="fl header-menu-mega-col header-menu-mega-col3 v-col-lg-3 v-col-md-3">
                <div class="hd_hotline">
                    {$g_views_BlockArea->display_area('hd_hotline')}
                </div>
            </div>
        
        </div>
    </div>
    
</div> <!-- End header wrap 8 -->
