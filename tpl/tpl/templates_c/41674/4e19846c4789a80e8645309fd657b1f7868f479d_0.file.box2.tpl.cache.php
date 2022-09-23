<?php
/* Smarty version 3.1.30, created on 2021-08-14 18:30:38
  from "/home/noith792/public_html/tpl/tpl/150/box2.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6117a95e1f1d74_37795440',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4e19846c4789a80e8645309fd657b1f7868f479d' => 
    array (
      0 => '/home/noith792/public_html/tpl/tpl/150/box2.tpl',
      1 => 1628940617,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6117a95e1f1d74_37795440 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '11544439026117a95e155cd8_01226633';
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
            		    <?php if ($_smarty_tpl->tpl_vars['real_price']->value == 800000) {?>
                            <?php $_smarty_tpl->_assignInScope('real_price', 799000);
?>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['real_price']->value == 15411000) {?>
                            <?php $_smarty_tpl->_assignInScope('real_price', 15420000);
?>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['real_price']->value == 15043000) {?>
                            <?php $_smarty_tpl->_assignInScope('real_price', 14900000);
?>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['real_price']->value == 30000000) {?>
                            <?php $_smarty_tpl->_assignInScope('real_price', 29920000);
?>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['real_price']->value == 12530000) {?>
                            <?php $_smarty_tpl->_assignInScope('real_price', 12990000);
?>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['real_price']->value == 14842000) {?>
                            <?php $_smarty_tpl->_assignInScope('real_price', 15990000);
?>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['real_price']->value == 16110000) {?>
                            <?php $_smarty_tpl->_assignInScope('real_price', 16100000);
?>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['post']->value['id'] == 170) {?>
                            <?php $_smarty_tpl->_assignInScope('real_price', 15990000);
?>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['post']->value['id'] == 205) {?>
                            <?php $_smarty_tpl->_assignInScope('real_price', 25100000);
?>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['real_price']->value != 15411000 || $_smarty_tpl->tpl_vars['real_price']->value != 800000 || $_smarty_tpl->tpl_vars['real_price']->value != 30000000 || $_smarty_tpl->tpl_vars['real_price']->value != 15043000 || $_smarty_tpl->tpl_vars['real_price']->value != 12530000 || $_smarty_tpl->tpl_vars['real_price']->value != 14842000 || $_smarty_tpl->tpl_vars['real_price']->value != 16110000 || $_smarty_tpl->tpl_vars['post']->value['info'] != 170 || $_smarty_tpl->tpl_vars['post']->value['info'] != 205) {?>
                            <?php $_smarty_tpl->_assignInScope('real_price', $_smarty_tpl->tpl_vars['real_price']->value);
?>
                        <?php }?>
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
