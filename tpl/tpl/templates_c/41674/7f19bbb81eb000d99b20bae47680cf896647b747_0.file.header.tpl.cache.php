<?php
/* Smarty version 3.1.30, created on 2021-08-22 05:58:49
  from "/home/noithatzip/domains/noithatzip.com/public_html/tpl/tpl/150/header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_61218529b939d0_76934300',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7f19bbb81eb000d99b20bae47680cf896647b747' => 
    array (
      0 => '/home/noithatzip/domains/noithatzip.com/public_html/tpl/tpl/150/header.tpl',
      1 => 1628220588,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61218529b939d0_76934300 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '185802097061218529b4ded0_49059682';
echo $_smarty_tpl->tpl_vars['g_functions']->value->display_extension_by_position('begin');?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->display_extension_by_position('after_open_head');?>

    <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->hcv_head();?>


    <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->cdn();?>


    <link href="<?php echo $_smarty_tpl->tpl_vars['c_fontend_template_url']->value;?>
/css/font.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap&subset=vietnamese" rel="stylesheet">
    <!--<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap&subset=vietnamese" rel="stylesheet">-->

    <link async rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['c_fontend_template_url']->value;?>
/css/css.css?v=2024" media="all"/>
    <link async rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['c_cdn_domain']->value;?>
/inc/css/cart.css?v=2024" media="all"/>


    <link async rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['c_fontend_template_url']->value;?>
/css/res.css?v=2024" media="all"/>
    <link async rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['c_fontend_template_url']->value;?>
/css/animate.css?v=2024" media="all"/>

    <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->display_carousel_cdn();?>


    
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['c_cdn_domain']->value;?>
/inc/js/cart.js?v=2024" async><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['c_fontend_template_url']->value;?>
/js/js.js?v=2024" async><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['c_fontend_template_url']->value;?>
/js/animate.js?v=2024" async><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 src="https://noithatzip.com/inc/js/lazysizes.min.js" async><?php echo '</script'; ?>
>
   

    <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->display_extension_by_position('before_close_head');?>

    

    
    <?php if (($_smarty_tpl->tpl_vars['g_functions']->value->checktype() == 'post')) {?>
        
        <?php echo '<script'; ?>
>
            dataLayer = [];
            dataLayer.push({
            'ecomm_prodid': <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->format_string($_smarty_tpl->tpl_vars['post_info']->value['masp']);?>
,
            'ecomm_pagetype': 'product'
            'ecomm_totalvalue': <?php echo $_smarty_tpl->tpl_vars['post_info']->value['gia'];?>

            });
        <?php echo '</script'; ?>
>
    
    <?php }?>
    <?php echo '<script'; ?>
 async src="https://www.googletagmanager.com/gtag/js?id=UA-164115835-1"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
    window.dataLayer = window.dataLayer || [];
    function gtag(){
        dataLayer.push(arguments);
          
    }
    gtag('js', new Date());
    
    gtag('config', 'UA-164115835-1');
    <?php echo '</script'; ?>
>
    
    <?php echo '<script'; ?>
>
        (function(w,d,s,l,i){
            w[l]=w[l]||[];
            w[l].push({
                'gtm.start':new Date().getTime(),event:'gtm.js'
            });
            var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';
            j.async=true;
            j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
            f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KFDGT86');
    <?php echo '</script'; ?>
>
    <meta name="google-site-verification" content="EOodLA17Va3ieeVakOifaJAi8S0bR21Tj0Ckd2lYmyI" />

</head>
<body class="v-tx-prl-5 v-xs-prl-5">
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KFDGT86"height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>    
<!-- Google Tag Manager (noscript) -->
<!--<noscript> -->
<!--  <iframe src = "https://www.googletagmanager.com/ns.html?id=GTM-NJV2BHW" height = "0" width = "0" style = "display:none;visibility:hidden" ></iframe>-->
<!--</noscript>-->
<!--End Google Tag Manager(noscript) -->
<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->display_extension_by_position('after_open_body');?>

<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->fb_sdk_js();?>

<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->wp_footer();?>


<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['c_cdn_tpl_tpl_path']->value)."/inc/header/header-2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<!-- End header-wrap -->
<?php }
}
