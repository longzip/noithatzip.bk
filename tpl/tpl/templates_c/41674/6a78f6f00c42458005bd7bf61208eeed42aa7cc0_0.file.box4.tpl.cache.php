<?php
/* Smarty version 3.1.30, created on 2020-04-02 05:17:44
  from "/home/noith792/public_html/tpl/tpl/150/box4.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e857578221098_22970695',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6a78f6f00c42458005bd7bf61208eeed42aa7cc0' => 
    array (
      0 => '/home/noith792/public_html/tpl/tpl/150/box4.tpl',
      1 => 1585804608,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e857578221098_22970695 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '21262352365e8575781fca16_47373683';
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
