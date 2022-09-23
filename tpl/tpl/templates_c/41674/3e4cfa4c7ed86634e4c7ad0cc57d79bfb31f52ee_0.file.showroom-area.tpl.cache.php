<?php
/* Smarty version 3.1.30, created on 2020-01-16 17:18:37
  from "/home/noith792/nhamay.noithatzip.com/tpl/tpl/150/category/showroom-area.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e209aed9a09b0_67429652',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3e4cfa4c7ed86634e4c7ad0cc57d79bfb31f52ee' => 
    array (
      0 => '/home/noith792/nhamay.noithatzip.com/tpl/tpl/150/category/showroom-area.tpl',
      1 => 1579195112,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../header.tpl' => 1,
    'file:../box2.tpl' => 1,
    'file:../sidebar.tpl' => 1,
    'file:../footer.tpl' => 1,
  ),
),false)) {
function content_5e209aed9a09b0_67429652 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '8994310805e209aed8f3c75_69687449';
$_smarty_tpl->_subTemplateRender("file:../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<style>
    #slide, #video-replace-slide{
        display:none;
    }
</style>

<div id="bread-crumb" class="v-full-width">
 
</div>

<div class="v-full-width middle">
    <section class="v-wrap-full" id="middle-content" style="margin-top: 0;">
        <div class="inner">
             
            
            <div class="fr  v-col-lg-12 v-col-md-12 v-col-sm-12 v-col-xs-12 v-col-tx-12 border-box" id="col2">
               <div class="col2-content" style="">
                        
                <div >
                    <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->display_bread_crumb();?>

                </div>
                
                <h1 id="" class="page-h1">
							<?php echo $_smarty_tpl->tpl_vars['category_info']->value['title'];?>
             
				</h1>
				<?php ob_start();
echo $_smarty_tpl->tpl_vars['category_info']->value['description'];
$_prefixVariable1=ob_get_clean();
if (!empty($_prefixVariable1)) {?>
				    <div class="cat-des">
				        <?php echo $_smarty_tpl->tpl_vars['category_info']->value['description'];?>

				    </div>
				<?php }?> 
                
                 
                <div class="col2-content v-lg-mr-20 v-md-mr-20 v-sm-mr-20" style="">
                        <?php $_smarty_tpl->_subTemplateRender("file:../box2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
ß
                </div>
                 
                <span class="clear"></span>
                
                <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->display_pagination();?>

                
                
                <span class="clear"></span>
                </div>
            </div>
			
			<!--<div id="sidebar" class="fl v-col-lg-3 v-col-md-4 v-col-sm-6 v-col-xs-12 v-col-tx-12">-->
   <!--             <?php $_smarty_tpl->_subTemplateRender("file:../sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
-->
   <!--         </div>-->
            <span class="clear"></span>
        </div>
    </section>
</div>

 
 
<span class="clear"></span>
<?php $_smarty_tpl->_subTemplateRender("file:../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
