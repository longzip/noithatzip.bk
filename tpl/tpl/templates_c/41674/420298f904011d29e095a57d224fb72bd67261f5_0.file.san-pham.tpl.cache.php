<?php
/* Smarty version 3.1.30, created on 2019-12-26 23:22:54
  from "/home/noith792/nhamay.noithatzip.com/tpl/tpl/150/post/san-pham.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e04de5eb83399_21324348',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '420298f904011d29e095a57d224fb72bd67261f5' => 
    array (
      0 => '/home/noith792/nhamay.noithatzip.com/tpl/tpl/150/post/san-pham.tpl',
      1 => 1577376899,
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
function content_5e04de5eb83399_21324348 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '7087456365e04de5e73b4a7_11245617';
$_smarty_tpl->_subTemplateRender("file:../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php if (empty($_smarty_tpl->tpl_vars['post_info']->value['other_images'])) {?>
    <?php $_smarty_tpl->_assignInScope('other_colors', array());
} else { ?>
    <?php $_smarty_tpl->_assignInScope('other_colors', json_decode($_smarty_tpl->tpl_vars['post_info']->value['other_images'],TRUE));
}?>

<?php if (!empty($_smarty_tpl->tpl_vars['post_info']->value['color1'])) {?>
    <?php $_smarty_tpl->_assignInScope('other_images', json_decode($_smarty_tpl->tpl_vars['post_info']->value['color1'],TRUE));
?>
 
<?php } elseif (!empty($_smarty_tpl->tpl_vars['post_info']->value['color2'])) {?>
    <?php $_smarty_tpl->_assignInScope('other_images', json_decode($_smarty_tpl->tpl_vars['post_info']->value['color2'],TRUE));
} elseif (!empty($_smarty_tpl->tpl_vars['post_info']->value['color3'])) {?>
    <?php $_smarty_tpl->_assignInScope('other_images', json_decode($_smarty_tpl->tpl_vars['post_info']->value['color3'],TRUE));
} else { ?>
    <?php $_smarty_tpl->_assignInScope('other_images', array());
}?>

<!--<?php if (!empty($_smarty_tpl->tpl_vars['post_info']->value['color1'])) {?>-->
<!--    <?php echo $_smarty_tpl->tpl_vars['count']->value++;?>
-->
<!--<?php }?>-->
<!--<?php if (!empty($_smarty_tpl->tpl_vars['post_info']->value['color2'])) {?>-->
<!--    <?php echo $_smarty_tpl->tpl_vars['count']->value++;?>
-->
<!--<?php }?>-->
<!--<?php if (!empty($_smarty_tpl->tpl_vars['post_info']->value['color3'])) {?>-->
<!--    <?php echo $_smarty_tpl->tpl_vars['count']->value++;?>
-->
<!--<?php }?>-->

<?php echo '<script'; ?>
 defer src="<?php echo $_smarty_tpl->tpl_vars['c_cdn_domain']->value;?>
/blocks/Slide/ListSlide/Light/src/js/lightslider.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['c_cdn_domain']->value;?>
/blocks/Slide/ListSlide/Light/src/css/lightslider.css" type="text/css" media="screen" />

<?php echo '<script'; ?>
>
	 $(document).ready(function() {
        $('.lightslider').lightSlider({
            gallery:true,
            item:1,
            thumbItem:4,
            slideMargin: 0,
            speed:400,
            auto:false,
            loop:false,
            onSliderLoad: function() {
                $('.lightslider').removeClass('cS-hidden');
            }  
        });
	});
<?php echo '</script'; ?>
>


   
<div id="bread-crumb" class="clearfix v-wrap-full">
    <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->display_bread_crumb();?>

</div>

<main id="main-content">
    <div id="site-cotnent-inner" class="v-wrap-full clearfix">
        <div class=" " id="col1">
            <div class="col1-content">
                <span class="clear"></span>
					
					<div id="general-info" class="clearfix" >
                        <div class="general-info-col general-info-col1 fl v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-12 v-col-tx-12">
                            <div class="general-info-col-inner general-info-col1-inner">
                                <?php if (!empty($_smarty_tpl->tpl_vars['post_info']->value['color1'])) {?>
                                    <?php $_smarty_tpl->_assignInScope('other_images', json_decode($_smarty_tpl->tpl_vars['post_info']->value['color1'],TRUE));
?>
                                    <div class=" gallery-wrap gallery-1 active">
                                    <ul class="gallery lightslider list-unstyled">
                                        <!--<li data-thumb="<?php echo timthumb_url($_smarty_tpl->tpl_vars['other_images']->value[0]['src'],600,600,FALSE);?>
">-->
                                        <!--    <img width="600" height="600" src="<?php echo timthumb_url($_smarty_tpl->tpl_vars['other_images']->value[0]['src'],600,600,FALSE);?>
" alt="" /> -->
                                        <!--</li>-->
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['other_images']->value, 'other_image', false, 'myKey');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['myKey']->value => $_smarty_tpl->tpl_vars['other_image']->value) {
?>
                                            <li key="<?php echo $_smarty_tpl->tpl_vars['myKey']->value;?>
" data-thumb="<?php echo timthumb_url($_smarty_tpl->tpl_vars['other_image']->value['src'],600,400,FALSE);?>
">
                                                <img width="600" height="400" src="<?php echo timthumb_url($_smarty_tpl->tpl_vars['other_image']->value['src'],600,400,FALSE);?>
" alt="" /> 
                                            </li>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                    </ul>
                                </div>
                                <?php }?>
                                
                                <?php if (!empty($_smarty_tpl->tpl_vars['post_info']->value['color2'])) {?>
                                    <?php $_smarty_tpl->_assignInScope('other_images', json_decode($_smarty_tpl->tpl_vars['post_info']->value['color2'],TRUE));
?>
                                    <div class="gallery-wrap gallery-2 active opacityWrap">
                                    <ul class="gallery lightslider list-unstyled">
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['other_images']->value, 'other_image', false, 'myKey');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['myKey']->value => $_smarty_tpl->tpl_vars['other_image']->value) {
?>
                                            <li key="<?php echo $_smarty_tpl->tpl_vars['myKey']->value;?>
" data-thumb="<?php echo timthumb_url($_smarty_tpl->tpl_vars['other_image']->value['src'],600,400,FALSE);?>
">
                                                <img width="600" height="400" src="<?php echo timthumb_url($_smarty_tpl->tpl_vars['other_image']->value['src'],600,400,FALSE);?>
" alt="" /> 
                                            </li>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                    </ul>
                                </div>
                                <?php }?>
                                
                                <?php if (!empty($_smarty_tpl->tpl_vars['post_info']->value['color3'])) {?>
                                    <?php $_smarty_tpl->_assignInScope('other_images', json_decode($_smarty_tpl->tpl_vars['post_info']->value['color3'],TRUE));
?>
                                    <div class="gallery-wrap gallery-3 active opacityWrap">
                                    <ul class="gallery lightslider list-unstyled">
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['other_images']->value, 'other_image', false, 'myKey');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['myKey']->value => $_smarty_tpl->tpl_vars['other_image']->value) {
?>
                                            <li key="<?php echo $_smarty_tpl->tpl_vars['myKey']->value;?>
" data-thumb="<?php echo timthumb_url($_smarty_tpl->tpl_vars['other_image']->value['src'],600,400,FALSE);?>
">
                                                <img width="600" height="400" src="<?php echo timthumb_url($_smarty_tpl->tpl_vars['other_image']->value['src'],600,400,FALSE);?>
" alt="" /> 
                                            </li>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                    </ul>
                                </div>
                                <?php }?>
                                
                            </div>
                        </div>
                        <div class="general-info-col general-info-col2 fl v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-12 v-col-tx-12">
                            <div class="general-info-col-inner general-info-col2-inner">
                                    <h1 id="page-h1" class="block-title"><?php echo $_smarty_tpl->tpl_vars['post_info']->value['title'];?>
</h1>
                                    
                                        <span class="clear"></span>
                                        <span class="ma-sp">
                                            <?php if (!empty($_smarty_tpl->tpl_vars['post_info']->value['masp'])) {?>
                                            <div class="ma-sp-inner">
                                                <span class="masp-label">Mã sản phẩm : </span>
                                                <span class="ma-sp-text"><?php echo $_smarty_tpl->tpl_vars['post_info']->value['masp'];?>
</span>
                                            </div>
                                            <?php }?>
                                        </span>
                                         <span class="clear"></span>
                                    	<div id="single-order" class="clearfix" >
            							    <?php if (!empty($_smarty_tpl->tpl_vars['post_info']->value['recent_km'])) {?>
            							        <?php $_smarty_tpl->_assignInScope('real_price', floor(($_smarty_tpl->tpl_vars['post_info']->value['gia']-($_smarty_tpl->tpl_vars['post_info']->value['recent_km']/100*$_smarty_tpl->tpl_vars['post_info']->value['gia']))/1000)*1000);
?>
            							        <?php $_smarty_tpl->_assignInScope('percent', 100*($_smarty_tpl->tpl_vars['post_info']->value['gia']-$_smarty_tpl->tpl_vars['real_price']->value)/$_smarty_tpl->tpl_vars['post_info']->value['gia']);
?>
            							        <?php $_tmp_array = isset($_smarty_tpl->tpl_vars['post_info']) ? $_smarty_tpl->tpl_vars['post_info']->value : array();
if (!is_array($_tmp_array) || $_tmp_array instanceof ArrayAccess) {
settype($_tmp_array, 'array');
}
$_tmp_array['gia_km'] = $_smarty_tpl->tpl_vars['real_price']->value;
$_smarty_tpl->_assignInScope('post_info', $_tmp_array);
?>
			                                    <span class="sale-percent">-  <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->floor($_smarty_tpl->tpl_vars['percent']->value);?>
%</span>
            							        
            							        <!--<?php $_smarty_tpl->_assignInScope('real_price', floor(($_smarty_tpl->tpl_vars['post']->value['gia']-($_smarty_tpl->tpl_vars['post']->value['recent_km']/100*$_smarty_tpl->tpl_vars['post']->value['gia']))/1000)*1000);
?>-->
            							        <div class="single-sale-price">
            										<span class="sale-price-label">Giá : </span>
            										<span class="sale-price-value"><?php echo $_smarty_tpl->tpl_vars['g_functions']->value->num_to_price($_smarty_tpl->tpl_vars['post_info']->value['gia']);?>
 đ</span>
            									</div>
            									
            									<div class="single-price">
            									    <!--<?php $_smarty_tpl->_assignInScope('real_price', $_smarty_tpl->tpl_vars['post_info']->value['recent_km']);
?>-->
            									    <!--<?php $_smarty_tpl->_assignInScope('real_price', floor(($_smarty_tpl->tpl_vars['post_info']->value['gia']-($_smarty_tpl->tpl_vars['post_info']->value['recent_km']/100*$_smarty_tpl->tpl_vars['post_info']->value['gia']))/1000)*1000);
?>-->
            										<span class="price-label">Giá KM: </span>
            										<span class="price-value"><?php echo $_smarty_tpl->tpl_vars['g_functions']->value->num_to_price($_smarty_tpl->tpl_vars['real_price']->value);?>
 đ</span>
            									</div>
            								<?php } else { ?>
            								    <?php $_smarty_tpl->_assignInScope('real_price', $_smarty_tpl->tpl_vars['post_info']->value['gia']);
?>
            
            									<div class="single-price fl v-col-lg-6 ">
            										<span class="price-label">Giá : </span>
            										<span class="price-value"><?php echo $_smarty_tpl->tpl_vars['g_functions']->value->num_to_price($_smarty_tpl->tpl_vars['real_price']->value);?>
 đ</span>
            									</div>
            							    <?php }?>
            							    
                                            							    
            							</div>
            							<span class="clear"></span>
            					
            							<div class="color-sp">
                            
                                            <div class="color-sp-inner">
                                                <span class="color-label">Màu săc : </span>
                                                <span class="color-sp-text">
                                                    <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? count($_smarty_tpl->tpl_vars['other_colors']->value)-1+1 - (0) : 0-(count($_smarty_tpl->tpl_vars['other_colors']->value)-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                                                        <li key="<?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
" id="mausac<?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
" data-thumb="<?php echo timthumb_url($_smarty_tpl->tpl_vars['other_colors']->value[$_smarty_tpl->tpl_vars['i']->value]['src'],100,100,FALSE);?>
">
                                                            <img width="50" height="50" src="<?php echo timthumb_url($_smarty_tpl->tpl_vars['other_colors']->value[$_smarty_tpl->tpl_vars['i']->value]['src'],100,100,FALSE);?>
" alt="" /> 
                                                        </li>
                                                    <?php }
}
?>

                                                ́</span>
                                            </div>
                                           
                                        </div>
                                        <span class="clear"></span>
            							<div class="single-des">
            							    <!--<?php echo $_smarty_tpl->tpl_vars['post_info']->value['description'];?>
-->
            							</div>
            							<span class="clear"></span>
            							<div class="buy-product">
            							    <span class="add-to-cart" price="<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->price_to_num($_smarty_tpl->tpl_vars['real_price']->value);?>
" particular="<?php echo $_smarty_tpl->tpl_vars['post_info']->value['id'];?>
">Đặt hàng</span>
            							</div>
        							    <!--<?php if (!$_smarty_tpl->tpl_vars['g_functions']->value->wp_is_mobile()) {?>-->
        							    <!--    <span class="add-to-cart block " price="<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->price_to_num($_smarty_tpl->tpl_vars['real_price']->value);?>
" particular="<?php echo $_smarty_tpl->tpl_vars['post_info']->value['id'];?>
">Đặt hàng</span>-->
        							    <!--<?php }?>-->
        							    
                            </div> 
                        </div>
                    </div> 
                
                    <div class="hr"></div>
                    
                    <div id="post-cols" class="clearfix">
                        <div class="fl  v-col-lg-9 v-col-md-8 v-col-sm-6 v-col-xs-12 v-col-tx-12 border-box v-lg-pr-25 v-md-pr-25 v-sm-pr-25" id="col2">
                            <div id="wrap-post-content"  >
                                    <div class="v-tabs">
                                       <div class="v-tabs-nav">
                                          <div class="v-tabs-nav-inner">
                                              <div class="v-tabs-nav-item">
                                                <h4 class="tabs-title">Thông tin chi tiết</h4>                            
                                             </div>
                                             <div class="v-tabs-nav-item">
                                                <h4 class="tabs-title">Thông số</h4>                               
                                             </div>
                                             
                                          </div>
                                       </div>
                                       <div class="v-tabs-content">
                                          <div class="v-tabs-content-item" >
                                             <div id="post-content" class="expend-des">
                    							<?php echo $_smarty_tpl->tpl_vars['post_info']->value['content'];?>

                    							<span class="clear"></span>
             
                    						</div>
                                            <div class="expend-des-bottom"></div>

                                          </div>
                                       </div>
                                       <div class="v-tabs-content-item" >
                                             <!--<?php echo $_smarty_tpl->tpl_vars['g_views_BlockArea']->value->display_area('thong-so');?>
-->
                                             <?php echo $_smarty_tpl->tpl_vars['post_info']->value['description'];?>

                                          </div>
                                       
                                       
                                    </div>
                            
            					</div>
                                <span class="clear"></span>
                                
                        </div>
                    </div>
                    <div class="hr hr-2"></div>
            </div>
        </div>
        <span class="clear"></span>
        <div class="more-detail">
	        <div class="form-content">
	            <?php echo $_smarty_tpl->tpl_vars['g_views_BlockArea']->value->display_area('more-detail');?>

	        </div>
	    </div>
	        
        <span class="clear"></span>
        <div class="relative-posts">
	        <div class="block-title">Sản phẩm liên quan</div>
	        <div class="block-content">
	            <?php $_smarty_tpl->_assignInScope('posts', $_smarty_tpl->tpl_vars['g_functions']->value->get_relative_posts(array('posts_per_page'=>4,'filter_by'=>'category','order'=>'ORDER BY time_update DESC')));
?>
	            <?php $_smarty_tpl->_subTemplateRender("file:../box2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	        </div>
	    </div>
	    <span class="clear"></span>
	    
    </div>
</main>

<?php $_smarty_tpl->_subTemplateRender("file:../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
