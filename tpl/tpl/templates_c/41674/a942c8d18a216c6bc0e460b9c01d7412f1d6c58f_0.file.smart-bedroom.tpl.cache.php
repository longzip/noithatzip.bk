<?php
/* Smarty version 3.1.30, created on 2020-04-02 05:21:45
  from "/home/noith792/public_html/tpl/tpl/150/post/smart-bedroom.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e8576690c9ae9_61642174',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a942c8d18a216c6bc0e460b9c01d7412f1d6c58f' => 
    array (
      0 => '/home/noith792/public_html/tpl/tpl/150/post/smart-bedroom.tpl',
      1 => 1585804608,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../header.tpl' => 1,
    'file:../box-relative-post.tpl' => 1,
    'file:../footer.tpl' => 1,
  ),
),false)) {
function content_5e8576690c9ae9_61642174 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '17533633185e85766909bee0_45338794';
$_smarty_tpl->_subTemplateRender("file:../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="smart-bedroom clearfix">
    <div class="v-wrap-full">
        <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->block_area_tabs('smart-bedroom','click');?>

        <div class="cart-smartBedroom" ><span class="item-action view-cart inline">Đặt vào giỏ hàng</span></div>
        <div class="instruct">
            <?php echo $_smarty_tpl->tpl_vars['g_views_BlockArea']->value->display_area('instruct');?>

            <div class="btn-start">Bắt đầu</div>
        </div>
    </div>
    
</div>
<span class="clear"></span>
        <div class="relative-post v-wrap-full">
            <h3 class="page-h1">Tin liên quan</h3>
            <?php $_smarty_tpl->_assignInScope('posts', $_smarty_tpl->tpl_vars['g_functions']->value->get_relative_posts(array('field'=>'*','posts_per_page'=>4,'filter_by'=>'category','order'=>'ORDER BY time_update DESC')));
?>
            <?php $_smarty_tpl->_subTemplateRender("file:../box-relative-post.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        </div>
<div id="loader" style="display:none"></div>
<?php $_smarty_tpl->_subTemplateRender("file:../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
