<?php
/* Smarty version 3.1.30, created on 2020-04-05 07:36:02
  from "/home/noith792/public_html/tpl/tpl/150/search/default.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e898a62d96632_98166780',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c3891d67cbdc71a09c7a38ae445f8eb1cd06f016' => 
    array (
      0 => '/home/noith792/public_html/tpl/tpl/150/search/default.tpl',
      1 => 1585804608,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../header.tpl' => 1,
    'file:../box2.tpl' => 1,
    'file:../footer.tpl' => 1,
  ),
),false)) {
function content_5e898a62d96632_98166780 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '5566622755e898a62aec864_43877562';
$_smarty_tpl->_subTemplateRender("file:../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<div id="bread-crumb" class="v-full-width">
 
</div>

<div class="v-full-width middle">
    <section class="v-wrap-full" id="middle-content" style="margin-top: 0;">
        <div class="inner">
            <div id="sidebar" class="fl v-col-lg-3 v-col-md-4 v-col-sm-6 v-xs-none v-tx-none">
                <div class="inner v-lg-pr-20 v-md-pr-20 v-sm-pr-20">
                      <?php echo $_smarty_tpl->tpl_vars['g_views_BlockArea']->value->display_area('sidebar');?>

                </div>
            </div>
            
            <div class="fr v-col-lg-9 v-col-md-8 v-col-sm-6 v-col-xs-12 v-col-tx-12" id="col2">
                <div class="" style="padding: 15px;">
                <h1 class="page-h1">Kết quả tìm kiếm cho "<?php echo $_GET['s'];?>
"</h1>
                <div class="archive">
                   <?php $_smarty_tpl->_subTemplateRender("file:../box2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                    <span class="clear"></span>
                </div>
                <span class="clear"></span>
                 <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->display_pagination();?>

                </div>
            </div>
            <span class="clear"></span>
        </div>
    </section>
</div>

 
 
<span class="clear"></span>
<?php $_smarty_tpl->_subTemplateRender("file:../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
