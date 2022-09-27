<?php
/* Smarty version 3.1.30, created on 2020-04-02 06:09:50
  from "/home/noith792/public_html/tpl/tpl/150/post/chi-tiet-showroom.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e8581aea14a70_24181050',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bbff4990a767978f96640bcd8b0aee4796205caf' => 
    array (
      0 => '/home/noith792/public_html/tpl/tpl/150/post/chi-tiet-showroom.tpl',
      1 => 1585804608,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../header.tpl' => 1,
    'file:../footer.tpl' => 1,
  ),
),false)) {
function content_5e8581aea14a70_24181050 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '6816646885e8581ae8e58d7_19171027';
$_smarty_tpl->_subTemplateRender("file:../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['c_fontend_template_url']->value;?>
/css/showRoom.css?v=<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
" media="all"/>
<?php if (empty($_smarty_tpl->tpl_vars['post_info']->value['others_img'])) {?>
    <?php $_smarty_tpl->_assignInScope('other_images', array());
} else { ?>
    <?php $_smarty_tpl->_assignInScope('other_images', json_decode($_smarty_tpl->tpl_vars['post_info']->value['others_img'],TRUE));
}?>

<div class="v-full-width wrap-dieu-huong" id="breadcrumbs">
    <div class="dieu-huong v-wrap-full bread-crumb">
        <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->display_bread_crumb();?>

    </div> <!-- dieu-huong -->
</div>
<div id="main-content">
	<div class="v-wrap-full">
		<div class="content-inner clearfix v-xs-mr-15 v-xs-ml-15 v-tx-mr-15 v-tx-ml-15">

			<div class=" ">
            <div class="content v-mr-10 v-ml-10">
               <article>
                  <section id="general-info" class="list-style list-style-1 ">
						<div class="general-info1 v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-12 v-col-tx-12 v-lg-float-left  v-md-float-left v-sm-float-left v-xs-float-none v-tx-float-none">
							<div id="sidebar-inner" class="v-lg-mr-25 v-md-mr-25 v-sm-mr-25">
								
								<div class="fr image-pro">
										<img alt="<?php echo $_smarty_tpl->tpl_vars['post_info']->value['title'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['post_info']->value['title'];?>
" src="<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->timthumb_url($_smarty_tpl->tpl_vars['post_info']->value['image'],600,400);?>
" id="main-image" />
								</div>
								<div class="showroom-inner other-images fl">
									<div class="other-image">
										<img large_src="<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->timthumb_url($_smarty_tpl->tpl_vars['post_info']->value['image'],600,400,FALSE);?>
" class="active" alt="<?php echo $_smarty_tpl->tpl_vars['post_info']->value['title'];?>
" src="<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->timthumb_url($_smarty_tpl->tpl_vars['post_info']->value['image'],150,100);?>
" />
									</div>
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['other_images']->value, 'other_image');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['other_image']->value) {
?>
											<div class="other-image">
												<img large_src="<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->timthumb_url($_smarty_tpl->tpl_vars['other_image']->value['src'],600,400,FALSE);?>
" src="<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->timthumb_url($_smarty_tpl->tpl_vars['other_image']->value['src'],150,100);?>
" />
											</div>
									<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

								</div>
								<span class="clear"></span>
							</div>
							 
						</div>
						 
						<div id="single-info" class="showRoomItem general-info2 v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-12 v-col-tx-12 v-lg-float-right  v-md-float-right v-sm-float-right v-xs-float-none v-tx-float-none">
							<h1 id="single-h1"><?php echo $_smarty_tpl->tpl_vars['post_info']->value['title'];?>
</h1>
							
							<div class="address showRoomOther showRoomOtherPlace">
							    <i class="fa fa-map-marker"></i>
							    <?php if (empty($_smarty_tpl->tpl_vars['post_info']->value['showroom_dia_chi'])) {?>
                                    <span>Địa chỉ chưa được cập nhật </span>
                                <?php } else { ?>
                                    <?php echo $_smarty_tpl->tpl_vars['post_info']->value['showroom_dia_chi'];?>

                                <?php }?>
							</div>
							<div class="google-map showRoomOther showRoomOtherMap">
							    <i class="fa fa-map-marker"></i>
							    <?php if (empty($_smarty_tpl->tpl_vars['post_info']->value['showroom_map'])) {?>
                                    <span>Bản đồ chưa được cập nhật </span>
                                <?php } else { ?>
                                    <a href=<?php echo $_smarty_tpl->tpl_vars['post_info']->value['showroom_map'];?>
>Chỉ đường cho tôi</a>
                                <?php }?>
							</div>
							<div class="phone showRoomOther showRoomOtherPhone">
							    <i class="fa fa-phone"></i>
							    <?php if (empty($_smarty_tpl->tpl_vars['post_info']->value['showroom_phone'])) {?>
                                    <span>Số điện thoại chưa được cập nhật </span>
                                <?php } else { ?>
                                    <a href=<?php echo $_smarty_tpl->tpl_vars['post_info']->value['showroom_phone'];?>
><?php echo $_smarty_tpl->tpl_vars['post_info']->value['showroom_phone'];?>
</a>
                                <?php }?>
							</div>
							<div class="single-des">
							    <?php if (empty($_smarty_tpl->tpl_vars['post_info']->value['description'])) {?>
                                    <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->the_excerpt_max_charlength(strip_tags($_smarty_tpl->tpl_vars['post_info']->value['content']),300);?>

                                <?php } else { ?>
                                    <?php echo $_smarty_tpl->tpl_vars['post_info']->value['description'];?>

                                <?php }?>
 
							</div>
						</div>    
					</section>
                    <span class="clear"></span>
               </article>
            </div> <!-- content -->
			</div> <!-- .v-col-lg-9 -->

			  <!-- .v-col-lg-3 -->
		</div> <!-- .content-inner -->
	</div> <!-- .v-wrap-full -->
     <!-- .v-wrap-full -->
</div> <!--#main-content-->
<?php $_smarty_tpl->_subTemplateRender("file:../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
