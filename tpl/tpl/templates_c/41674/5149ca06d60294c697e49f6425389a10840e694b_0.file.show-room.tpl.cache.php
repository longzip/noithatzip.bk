<?php
/* Smarty version 3.1.30, created on 2020-01-16 16:53:46
  from "/home/noith792/nhamay.noithatzip.com/tpl/tpl/150/post/show-room.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e20951a8c3066_86095929',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5149ca06d60294c697e49f6425389a10840e694b' => 
    array (
      0 => '/home/noith792/nhamay.noithatzip.com/tpl/tpl/150/post/show-room.tpl',
      1 => 1579193620,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../header.tpl' => 1,
    'file:../footer.tpl' => 1,
  ),
),false)) {
function content_5e20951a8c3066_86095929 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '16947649125e20951a832013_89680263';
$_smarty_tpl->_subTemplateRender("file:../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['c_fontend_template_url']->value;?>
/js/showRoom.js?v=<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['c_cdn_domain']->value;?>
/inc/js/ecommerce.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['c_fontend_template_url']->value;?>
/css/showRoom.css?v=<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
" media="all"/>

<div class="show-room clearfix">
    <div class="showroom-inner v-wrap-full">
        <div class="showroom-title">
            <h2>hệ thống showroom</h2>
        </div>
        <div class="showRoomContent">
          <div class="showRoomContentInner">
            <div class="showRoomCol1 fl">
              <?php echo $_smarty_tpl->tpl_vars['g_views_BlockArea']->value->display_area('defaultShowRoom');?>

            </div>
            <div class="showRoomCol2 fl">
              <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->advanced_search_by_field(array('field'=>'khu_vuc'));?>

              <div class="listShowRoom"></div>
            </div>

          </div>
        </div>
    </div>
</div>
<span class="clearfix"></span>
<?php $_smarty_tpl->_subTemplateRender("file:../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
