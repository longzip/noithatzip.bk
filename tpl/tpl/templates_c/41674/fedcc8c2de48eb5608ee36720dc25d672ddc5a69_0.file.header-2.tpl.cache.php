<?php
/* Smarty version 3.1.30, created on 2019-12-21 12:44:18
  from "/home/noith792/nhamay.noithatzip.com/tpl/tpl/inc/header/header-2.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5dfdb1328e9269_04855861',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fedcc8c2de48eb5608ee36720dc25d672ddc5a69' => 
    array (
      0 => '/home/noith792/nhamay.noithatzip.com/tpl/tpl/inc/header/header-2.tpl',
      1 => 1568420281,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5dfdb1328e9269_04855861 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '18473136095dfdb1328bede1_88040866';
?>
<div id="header-wrap-2" class="header-wrap">
    <div id="top-bar" class="clearfix v-xs-none v-tx-none">
        <div id="top-bar-inner" class="v-wrap-full">
            <div class="top-bar-inner-wrap clearfix">
                <div class="fl top-content-col top-content-col1 v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-12 v-col-tx-12">
                    
                    <div class="top-content top-content-left clearfix">
                        <?php echo $_smarty_tpl->tpl_vars['g_views_BlockArea']->value->display_area('top-content-left');?>

                    </div>
                    
                </div>
                
                <div class="fl top-content-col top-content-col2 v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-12 v-col-tx-12">
                    
                    <div class="top-content top-content-right clearfix">
                        <?php echo $_smarty_tpl->tpl_vars['g_views_BlockArea']->value->display_area('top-content-right');?>

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- End top-bar -->
    
    <header id="header" class="clearfix fixed-on-scroll fixed-on-scroll-1 has-fixed-on-scroll">
        <div id="header-inner" class="v-wrap-full">
            <div class="header-inner-wrap clearfix">
                <div id="logo-wrap" class="fl v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-sx-12 v-col-tx-12 v-xs-float-none v-tx-float-none">
                    <div id="logo" class="v-xs-text-align-center v-tx-text-align-center">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['c_site_url']->value;?>
">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->get_option('logo');?>
" alt="" />
                            <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->display_edit_option_icon('logo','image');?>

                        </a>
                    </div>
                    
                </div>
                
                <div id="header-content" class="fl v-col-lg-9 v-col-md-9">
                    
                    <nav id="main-menu" class="clearfix">
                        <?php echo $_smarty_tpl->tpl_vars['g_views_BlockArea']->value->display_area('main-menu');?>

                    </nav>
                    
                </div>
                
            </div>
        </div> 
    </header>
    <!-- End header -->
</div>
<!-- End header-wrap -->


<?php }
}
