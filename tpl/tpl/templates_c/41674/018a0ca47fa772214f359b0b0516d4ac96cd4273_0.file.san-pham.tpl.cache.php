<?php
/* Smarty version 3.1.30, created on 2019-12-21 14:21:16
  from "/home/noith792/nhamay.noithatzip.com/tpl/tpl/150/category/san-pham.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5dfdc7ec522d20_98407457',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '018a0ca47fa772214f359b0b0516d4ac96cd4273' => 
    array (
      0 => '/home/noith792/nhamay.noithatzip.com/tpl/tpl/150/category/san-pham.tpl',
      1 => 1568419221,
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
function content_5dfdc7ec522d20_98407457 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '3887750795dfdc7ec44ba20_61553100';
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
             
            
            <div class="fr v-col-lg-9 v-col-md-9 v-col-sm-6 v-col-xs-12 v-col-tx-12 border-box v-lg-pl-25 v-md-pl-25 v-sm-pl-25" id="col2">
               <div class="col2-content" style="">
                        
                <div >
                    <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->display_bread_crumb();?>

                </div>
                
                <h1 id="" class="page-h1"><?php echo $_smarty_tpl->tpl_vars['category_info']->value['title'];?>
</h1>
                <?php if (!empty($_smarty_tpl->tpl_vars['category_info']->value['description'])) {?>
				    <div class="cat-des">
				        <?php echo $_smarty_tpl->tpl_vars['category_info']->value['description'];?>

				    </div>
				<?php }?> 
                 
                    <div class="col2-content v-lg-mr-20 v-md-mr-20 v-sm-mr-20" style="">
                     <?php $_smarty_tpl->_subTemplateRender("file:../box2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

                      
                </div>
                 
                <span class="clear"></span>
                
               <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->display_pagination();?>

               
                <span class="clear"></span>
                </div>
            </div>
			
			<div id="sidebar" class="fl v-col-lg-3 v-col-md-3 v-col-sm-6 v-col-xs-12 v-col-tx-12">
                <?php $_smarty_tpl->_subTemplateRender("file:../sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

            </div>
            <span class="clear"></span>
        </div>
    </section>
</div>

 
 
<span class="clear"></span>
<?php $_smarty_tpl->_subTemplateRender("file:../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
