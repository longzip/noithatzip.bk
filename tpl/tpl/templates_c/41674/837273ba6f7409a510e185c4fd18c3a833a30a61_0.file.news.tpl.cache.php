<?php
/* Smarty version 3.1.30, created on 2021-08-22 13:12:30
  from "/home/noithatzip/domains/noithatzip.com/public_html/tpl/tpl/150/post/news.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6121eace3cb921_01359776',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '837273ba6f7409a510e185c4fd18c3a833a30a61' => 
    array (
      0 => '/home/noithatzip/domains/noithatzip.com/public_html/tpl/tpl/150/post/news.tpl',
      1 => 1585804608,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../header.tpl' => 1,
    'file:../box-relative-post.tpl' => 1,
    'file:../footer.tpl' => 1,
  ),
),false)) {
function content_6121eace3cb921_01359776 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1982164526121eace3847d2_34212945';
$_smarty_tpl->_subTemplateRender("file:../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<style>
    #slide, #video-replace-slide {
        display: none;
    }
</style>
<div class="middle v-wrap-full" id="post-middle">

    <div class="post-content">
        <div id="wrap-post-content">
            <div class="">
                <div class="">
                    <div class="">
                        <div class="dieu-huong  bread-crumb">
                            <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->display_bread_crumb();?>

                        </div>
                        <div class="main-content">
                            <h1 class="page-h1" id="news-page-h1"><?php echo $_smarty_tpl->tpl_vars['post_info']->value['title'];?>
</h1>
                            <div id="post-content" style="padding: 0;">
                                <?php echo $_smarty_tpl->tpl_vars['post_info']->value['content'];?>

                                <span class="clear"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <span class="clear"></span>
        <div class="more-detail">
	        <div class="form-content">
	            <?php echo $_smarty_tpl->tpl_vars['g_views_BlockArea']->value->display_area('more-detail');?>

	        </div>
	    </div>
	        
        <span class="clear"></span>
        <div class="relative-post">
            <h3 class="page-h1">Tin liên quan</h3>
            <?php $_smarty_tpl->_assignInScope('posts', $_smarty_tpl->tpl_vars['g_functions']->value->get_relative_posts(array('field'=>'*','posts_per_page'=>4,'filter_by'=>'category','order'=>'ORDER BY time_update DESC')));
?>
            <?php $_smarty_tpl->_subTemplateRender("file:../box-relative-post.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        </div>

    </div>
    <span class="clear"></span>

</div>


<span class="clear"></span>
<?php $_smarty_tpl->_subTemplateRender("file:../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
