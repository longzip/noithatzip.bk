<?php
/* Smarty version 3.1.30, created on 2019-12-21 14:21:30
  from "/home/noith792/nhamay.noithatzip.com/tpl/tpl/150/category/showroom.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5dfdc7fab14523_48291582',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2a7c1ebe10609ed7bef8985400f0de23432b720f' => 
    array (
      0 => '/home/noith792/nhamay.noithatzip.com/tpl/tpl/150/category/showroom.tpl',
      1 => 1576912867,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../header.tpl' => 1,
    'file:../sidebar.tpl' => 1,
    'file:../footer.tpl' => 1,
  ),
),false)) {
function content_5dfdc7fab14523_48291582 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '11229686335dfdc7faa41828_14550056';
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
				<?php if (!empty($_smarty_tpl->tpl_vars['category_info']->value['description'])) {?>
				    <div class="cat-des">
				        <?php echo $_smarty_tpl->tpl_vars['category_info']->value['description'];?>

				    </div>
				<?php }?> 
                
                 
                <div class="col2-content v-lg-mr-20 v-md-mr-20 v-sm-mr-20" style="">
                        <?php echo $_smarty_tpl->tpl_vars['g_views_BlockArea']->value->display_area('ten_block_area');?>

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
