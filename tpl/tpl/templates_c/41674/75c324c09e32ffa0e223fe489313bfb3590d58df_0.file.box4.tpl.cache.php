<?php
/* Smarty version 3.1.30, created on 2021-08-22 05:58:49
  from "/home/noithatzip/domains/noithatzip.com/public_html/tpl/tpl/150/box4.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_61218529c56e19_24244689',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '75c324c09e32ffa0e223fe489313bfb3590d58df' => 
    array (
      0 => '/home/noithatzip/domains/noithatzip.com/public_html/tpl/tpl/150/box4.tpl',
      1 => 1585804608,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61218529c56e19_24244689 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '164837769461218529c36389_65647104';
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts']->value, 'post');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
?>
    <div class="showroom-box  animated slideInLeft delay-500 go fl v-col-lg-4 v-col-md-4 v-col-sm-4 v-col-xs-6 v-col-tx-6">
        <div class="showroom-wr">
            <div class="showroom-wr-inner">
                <div class="box-border">
                    <div class=" showroom-image1">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" class="" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->timthumb_url($_smarty_tpl->tpl_vars['post']->value['image'],640,380);?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
"
                                 alt="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
"/>
                        </a>
                    </div>
                    <div class="showroom-tt">
                        <div class="title-box">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" class="news-product-title" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</a>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>

        </div>

    </div>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

<?php }
}
