<?php
/* Smarty version 3.1.30, created on 2020-03-12 14:16:09
  from "/home/noith792/nhamay.noithatzip.com/tpl/tpl/150/footer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e6a4429a41c68_67277635',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '60cc644d2d9e79851565d20cc85ff65ff881eacf' => 
    array (
      0 => '/home/noith792/nhamay.noithatzip.com/tpl/tpl/150/footer.tpl',
      1 => 1584022525,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e6a4429a41c68_67277635 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '16231810815e6a44299a06f2_28429692';
?>
<!--<div class="near-footer v-wrap-full">-->
<!--    <?php echo $_smarty_tpl->tpl_vars['g_views_BlockArea']->value->display_area('near-footer');?>
 -->
<!--</div>-->
<div id='fb-root' > </div>



<?php echo '<script'; ?>
>

(function(d, s, id) {     
    var js, fjs = d.getElementsByTagName(s)[0];     
    js = d.createElement(s); js.id = id;     
    js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';     
    fjs.parentNode.insertBefore(js, fjs);   
}(document, 'script', 'facebook-jssdk'));
<?php echo '</script'; ?>
>   
<div class='fb-customerchat' page_id='257211167713227' theme_color='#009e4a' logged_in_greeting= 'Xin chào, tôi có thể hổ trợ gì cho bạn không?' logged_out_greeting = 'Xin chào, tôi có thể hổ trợ gì cho bạn không?' > </div>

<?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['c_cdn_tpl_tpl_path']->value)."/inc/footer/footer-3.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>


<span class="go-to-top"><i class="fa fa-arrow-up"></i></span>
  
<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->display_extension_by_position('before_close_body');?>


</body>
</html><?php }
}
