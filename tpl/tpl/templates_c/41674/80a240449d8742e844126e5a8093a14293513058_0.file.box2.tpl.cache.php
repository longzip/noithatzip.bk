<?php
/* Smarty version 3.1.30, created on 2020-01-16 17:21:48
  from "/home/noith792/nhamay.noithatzip.com/tpl/tpl/150/box2.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e209bac454e58_90964731',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '80a240449d8742e844126e5a8093a14293513058' => 
    array (
      0 => '/home/noith792/nhamay.noithatzip.com/tpl/tpl/150/box2.tpl',
      1 => 1579192444,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e209bac454e58_90964731 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '11034651325e209bac331c27_69174236';
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts']->value, 'post');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
?>

<?php if (empty($_smarty_tpl->tpl_vars['post']->value['gia_km'])) {?>
    <?php $_smarty_tpl->_assignInScope('real_price', $_smarty_tpl->tpl_vars['post']->value['gia']);
} else { ?>
    <?php $_smarty_tpl->_assignInScope('real_price', $_smarty_tpl->tpl_vars['post']->value['gia_km']);
}?>

<div class="item fl border-box v-col-lg-4 v-col-md-4 v-col-sm-6 v-col-xs-6 v-col-tx-6">
		<div class="img-chi-tiet">
			<div class="img">
				<a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
"><img   src="<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->timthumb_url($_smarty_tpl->tpl_vars['post']->value['image'],600,400);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
" /></a>
				<!--<p class="item-action add-to-cart inline"   price="<?php echo $_smarty_tpl->tpl_vars['real_price']->value;?>
" particular="<?php echo $_smarty_tpl->tpl_vars['post']->value['id'];?>
" ><span>Mua ngay</span></p>-->
                <!--<a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" class="readmore-button item-action inline"><span>Chi tiết</span></a>-->
			</div>
			<!--<?php if (!empty($_smarty_tpl->tpl_vars['post']->value['gia_km'])) {?>-->
			<!--    <?php $_smarty_tpl->_assignInScope('percent', 100*($_smarty_tpl->tpl_vars['post']->value['gia']-$_smarty_tpl->tpl_vars['post']->value['gia_km'])/$_smarty_tpl->tpl_vars['post']->value['gia']);
?>-->
			<!--    <span class="sale-percent">-  <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->floor($_smarty_tpl->tpl_vars['percent']->value);?>
%</span>-->
			<!--<?php }?>-->
            <?php if (!empty($_smarty_tpl->tpl_vars['post']->value['recent_km'])) {?>
			    <span class="sale-percent">-  <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->floor($_smarty_tpl->tpl_vars['post']->value['recent_km']);?>
%</span>
			<?php }?>

			<div class="chi-tiet">
				<h3><a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</a></h3>
			</div>



            <div class="list-price">
                <?php if (!empty($_smarty_tpl->tpl_vars['post']->value['recent_km'])) {?>
            		<p class="price inline-block">
            		    <?php $_smarty_tpl->_assignInScope('real_price', floor(($_smarty_tpl->tpl_vars['post']->value['gia']-($_smarty_tpl->tpl_vars['post']->value['recent_km']/100*$_smarty_tpl->tpl_vars['post']->value['gia']))/1000)*1000);
?>
            			<span></span><?php echo $_smarty_tpl->tpl_vars['g_functions']->value->num_to_price($_smarty_tpl->tpl_vars['real_price']->value);?>
<span>₫</span>
            		</p>
            		<?php if (!empty($_smarty_tpl->tpl_vars['post']->value['gia'])) {?>
            		    <p class="price-old inline-block">
                			<span></span><?php echo $_smarty_tpl->tpl_vars['g_functions']->value->num_to_price($_smarty_tpl->tpl_vars['post']->value['gia']);?>
<span>₫</span>
                		</p>
            		<?php }?>
            	<?php } else { ?>
            	    <?php if (!empty($_smarty_tpl->tpl_vars['post']->value['gia'])) {?>
                        <p class="price-old inline-block">
                		</p>

                		<p class="price inline-block">
                			<span></span><?php echo $_smarty_tpl->tpl_vars['g_functions']->value->num_to_price($_smarty_tpl->tpl_vars['post']->value['gia']);?>
<span>₫</span>
                		</p>
                	<?php }?>
    			<?php }?>

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
