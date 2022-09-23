<?php
/* Smarty version 3.1.30, created on 2022-06-15 10:36:46
  from "/home/noithatzip/domains/noithatzip.com/public_html/tpl/tpl/150/box2.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_62a953cedbe310_95902659',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '57132a76e34bfff21ae9f8bcbcf851b360988847' => 
    array (
      0 => '/home/noithatzip/domains/noithatzip.com/public_html/tpl/tpl/150/box2.tpl',
      1 => 1655264205,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62a953cedbe310_95902659 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '158739212362a953ced50445_63095179';
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts']->value, 'post');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
?>

<?php if (empty($_smarty_tpl->tpl_vars['post']->value['gia_km'])) {?>
    <?php $_smarty_tpl->_assignInScope('real_price', $_smarty_tpl->tpl_vars['post']->value['gia']);
} else { ?>
    <?php if ($_smarty_tpl->tpl_vars['post']->value['gia_km'] == 24831000) {?>
        <?php $_smarty_tpl->_assignInScope('real_price', 24900000);
?>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['post']->value['gia_km'] == 15411000) {?>
        <?php $_smarty_tpl->_assignInScope('real_price', 15420000);
?>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['post']->value['gia_km'] == 30000000) {?>
        <?php $_smarty_tpl->_assignInScope('real_price', 29920000);
?>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['post']->value['gia_km'] != 15411000 || $_smarty_tpl->tpl_vars['post']->value['gia_km'] != 24831000 || $_smarty_tpl->tpl_vars['post']->value['gia_km'] != 30000000) {?>
        <?php $_smarty_tpl->_assignInScope('real_price', $_smarty_tpl->tpl_vars['post']->value['gia_km']);
?>
    <?php }?>
    
<?php }?>

<div class="item fl border-box v-col-lg-4 v-col-md-4 v-col-sm-6 v-col-xs-6 v-col-tx-6">
		<div class="img-chi-tiet">
			<div class="img">
				<a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
"><img class="lazyload" data-src="<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->timthumb_url($_smarty_tpl->tpl_vars['post']->value['image'],600,400);?>
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
