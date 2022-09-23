<?php
/* Smarty version 3.1.30, created on 2021-09-02 10:26:47
  from "/home/noithatzip/domains/noithatzip.com/public_html/tpl/tpl/150/search/default.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_613044776628c8_47857931',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a14ed688c7f4f6e38fbd631c300b13dba2b7e039' => 
    array (
      0 => '/home/noithatzip/domains/noithatzip.com/public_html/tpl/tpl/150/search/default.tpl',
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
function content_613044776628c8_47857931 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '896820368613044775fd148_29389932';
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
