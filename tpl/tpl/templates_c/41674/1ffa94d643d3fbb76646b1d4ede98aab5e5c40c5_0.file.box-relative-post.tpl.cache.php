<?php
/* Smarty version 3.1.30, created on 2021-08-22 06:01:07
  from "/home/noithatzip/domains/noithatzip.com/public_html/tpl/tpl/150/box-relative-post.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_612185b3af4de9_54513872',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1ffa94d643d3fbb76646b1d4ede98aab5e5c40c5' => 
    array (
      0 => '/home/noithatzip/domains/noithatzip.com/public_html/tpl/tpl/150/box-relative-post.tpl',
      1 => 1585804608,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_612185b3af4de9_54513872 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '2081759752612185b3ac0ba8_20589382';
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts']->value, 'post');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
?>

<div class="box-blog fl border-box v-col-lg-4 v-col-md-4 v-col-sm-12 v-col-xs-12 v-col-tx-12 ">
    <div class="box-blog-content v-mrl-15 ">
        
        <div class="box-blog-image">
            <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" class="" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
">
               <img class="hinh1" src="<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->timthumb_url($_smarty_tpl->tpl_vars['post']->value['image'],350,210,FALSE);?>
 " title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
" />
            </a>
        </div>
        
        <div class="box-text-tt">
            
        
        <h3 class="box-blog-content-title">
            <div class="blog-title-inner">
                <a href="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</a>
            </div>
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
