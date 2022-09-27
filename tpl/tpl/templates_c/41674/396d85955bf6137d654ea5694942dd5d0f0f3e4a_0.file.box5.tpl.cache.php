<?php
/* Smarty version 3.1.30, created on 2020-04-02 05:17:44
  from "/home/noith792/public_html/tpl/tpl/150/box5.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e857578283611_36004455',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '396d85955bf6137d654ea5694942dd5d0f0f3e4a' => 
    array (
      0 => '/home/noith792/public_html/tpl/tpl/150/box5.tpl',
      1 => 1585804608,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e857578283611_36004455 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '12374635935e857578248b16_06095916';
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts']->value, 'post');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
?>

<div class="box-blog fl border-box v-col-lg-3 v-col-md-3 v-col-sm-12 v-col-xs-12 v-col-tx-12 ">
    <div class="box-blog-content v-mrl-15 ">
        
        <div class="box-blog-image">
            <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" class="" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
">
               <img class="hinh1" src="<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->timthumb_url($_smarty_tpl->tpl_vars['post']->value['image'],600,400,FALSE);?>
 " title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
" />
            </a>
        </div>
        
        <div class="box-text-tt">
            
        
        <h3 class="box-blog-content-title">
                <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</a>
                
                 
        </h3>
        
        
        
        
             <div class="meta-item des">
                <?php if (empty($_smarty_tpl->tpl_vars['post']->value['description'])) {?>
                    <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->the_excerpt_max_charlength(strip_tags($_smarty_tpl->tpl_vars['post']->value['content']),100);?>

                <?php } else { ?>
                    <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->the_excerpt_max_charlength(strip_tags($_smarty_tpl->tpl_vars['post']->value['description']),100);?>

                <?php }?>
            </div>
            
          
         
        <div class="box-blog-text">
            <!--<div class="by-time">-->
            <!--        <spam class="by-date">-->
            <!--        <?php echo date("h",$_smarty_tpl->tpl_vars['post']->value['time_update']);?>
<a>h-</a>-->
            <!--        </spam>-->
            <!--         <spam class="by-year">-->
            <!--        <?php echo date("d/m/Y",$_smarty_tpl->tpl_vars['post']->value['time_update']);?>
-->
            <!--        </spam>-->
            <!--    </div>-->
                <div class="box-readmore">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
">Xem thêm</a>
                </div>
             

        </div>
        </div> 
    </div>
   
</div>

<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}
}
