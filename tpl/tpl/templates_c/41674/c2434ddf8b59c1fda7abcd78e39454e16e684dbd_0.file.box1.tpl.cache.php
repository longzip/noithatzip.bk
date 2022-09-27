<?php
/* Smarty version 3.1.30, created on 2020-01-21 20:55:36
  from "/home/noith792/nhamay.noithatzip.com/tpl/tpl/150/box1.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e2765484cd056_95953202',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c2434ddf8b59c1fda7abcd78e39454e16e684dbd' => 
    array (
      0 => '/home/noith792/nhamay.noithatzip.com/tpl/tpl/150/box1.tpl',
      1 => 1579640121,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e2765484cd056_95953202 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '13284012145e2765481ea6c7_00033172';
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts']->value, 'post');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
?>

<article class="news-box">
    <div class="fl news-image v-col-lg-3 v-col-md-3 v-col-sm-4 v-col-xs-12 v-col-tx-12">
        <div class="news-content">
            <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" class="" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
">
                <img src="<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->timthumb_url($_smarty_tpl->tpl_vars['post']->value['image'],600,400);?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
" />
            </a>
        </div>
    </div>

    <div class="fr text v-col-lg-9 v-col-md-9 v-col-sm-8 v-col-xs-12 v-col-tx-12">
        <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" class="news-product-title" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</a>
        <!--<div class="meta">( <?php echo date('H:i:s A - d/m/Y',$_smarty_tpl->tpl_vars['post']->value['time_update']);?>
 )</div>-->
        <span class="clear"></span>
        <div class="news-des">
            <?php if (empty($_smarty_tpl->tpl_vars['post']->value['description'])) {?>
                <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->the_excerpt_max_charlength(strip_tags($_smarty_tpl->tpl_vars['post']->value['content']),330);?>

            <?php } else { ?>
                <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->the_excerpt_max_charlength(strip_tags($_smarty_tpl->tpl_vars['post']->value['description']),330);?>

            <?php }?>
        </div>

        <span class="clear"></span>
        <a  href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" class="news-read-more">Xem thêm  »</a>
        <span class="clear"></span>
    </div>

    <span class="clear"></span>
</article>
<span class="clear"></span>

<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

<?php }
}
