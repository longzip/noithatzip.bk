<?php
/* Smarty version 3.1.30, created on 2020-10-23 14:56:21
  from "/home/noith792/public_html/tpl/tpl/150/footer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f928ca58cda23_83915174',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6ab65d8d6aa6caf4d761177a2e850f0dd4f90cb3' => 
    array (
      0 => '/home/noith792/public_html/tpl/tpl/150/footer.tpl',
      1 => 1603439774,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f928ca58cda23_83915174 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '10845225545f928ca58acfd6_48661449';
?>
<!--<div class="near-footer v-wrap-full">-->
<!--    <?php echo $_smarty_tpl->tpl_vars['g_views_BlockArea']->value->display_area('near-footer');?>
 -->
<!--</div>-->
<div id='fb-root' > </div>

<div class="fb-test ">
    <a class="fb-test-link" href="http://m.me/noithatzipvietnam"><img src="https://noithatzip.com/uploads/logo_fb.png" width="65px" height="65px"></a>
</div>


<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['c_cdn_tpl_tpl_path']->value)."/inc/footer/footer-3.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>


<span class="go-to-top"><i class="fa fa-arrow-up"></i></span>
  
<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->display_extension_by_position('before_close_body');?>

<div class="hotline-phone-ring-wrap">
	<div class="hotline-phone-ring">
		<div class="hotline-phone-ring-circle"></div>
		<div class="hotline-phone-ring-circle-fill"></div>
		<div class="hotline-phone-ring-img-circle">
		<a href="tel:0912996633" class="pps-btn-img">
			<img src="https://noithatzip.com/uploads/logo/icon-call-nh.png" alt="Gọi điện thoại" width="50">
		</a>
		</div>
	</div>
	<div class="hotline-bar">
		<a href="tel:0912996633">
			<span class="text-hotline">0912.99.66.33</span>
		</a>
	</div>
</div>
</body>
</html><?php }
}
