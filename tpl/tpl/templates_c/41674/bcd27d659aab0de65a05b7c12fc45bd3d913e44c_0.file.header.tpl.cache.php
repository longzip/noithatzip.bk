<?php
/* Smarty version 3.1.30, created on 2020-03-12 04:47:42
  from "/home/noith792/nhamay.noithatzip.com/tpl/tpl/150/header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e69beee5e15c7_08090817',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bcd27d659aab0de65a05b7c12fc45bd3d913e44c' => 
    array (
      0 => '/home/noith792/nhamay.noithatzip.com/tpl/tpl/150/header.tpl',
      1 => 1583988459,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e69beee5e15c7_08090817 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '3168807175e69beee5258d8_47594407';
echo $_smarty_tpl->tpl_vars['g_functions']->value->display_extension_by_position('begin');?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->display_extension_by_position('after_open_head');?>

    <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->hcv_head();?>


    <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->cdn();?>


    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap&subset=vietnamese" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap&subset=vietnamese" rel="stylesheet">
    <!--<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap&subset=vietnamese" rel="stylesheet">-->

    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['c_fontend_template_url']->value;?>
/css/css.css?v=<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
" media="all"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['c_cdn_domain']->value;?>
/inc/css/cart.css?v=<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
" media="all"/>


    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['c_fontend_template_url']->value;?>
/css/res.css?v=<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
" media="all"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['c_fontend_template_url']->value;?>
/css/animate.css?v=<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
" media="all"/>

    <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->display_carousel_cdn();?>



    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['c_cdn_domain']->value;?>
/inc/js/cart.js?v=<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['c_fontend_template_url']->value;?>
/js/js.js?v=<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['c_fontend_template_url']->value;?>
/js/animate.js?v=<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
"><?php echo '</script'; ?>
>

   
    <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->display_extension_by_position('before_close_head');?>

</head>
<body class="v-tx-prl-5 v-xs-prl-5">
<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->display_extension_by_position('after_open_body');?>

<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->fb_sdk_js();?>

<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->wp_footer();?>


<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['c_cdn_tpl_tpl_path']->value)."/inc/header/header-2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

<!-- End header-wrap -->
<?php }
}
