<?php
/* Smarty version 3.1.30, created on 2022-06-15 10:47:09
  from "/home/noithatzip/domains/noithatzip.com/public_html/tpl/tpl/150/post/san-pham.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_62a9563d6e4cc7_23528648',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '11768ea6803cf58fe8c30ed82ed85cf56e9f2863' => 
    array (
      0 => '/home/noithatzip/domains/noithatzip.com/public_html/tpl/tpl/150/post/san-pham.tpl',
      1 => 1655264164,
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
function content_62a9563d6e4cc7_23528648 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '69628229762a9563d5fe2b1_30060679';
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
 defer src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 defer src="<?php echo $_smarty_tpl->tpl_vars['c_cdn_domain']->value;?>
/blocks/Slide/ListSlide/Light/src/js/lightsliderproduct.js?v=1"><?php echo '</script'; ?>
>
<link defer rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['c_cdn_domain']->value;?>
/blocks/Slide/ListSlide/Light/src/css/lightslider.css" type="text/css" media="screen" />
<link defer href="<?php echo $_smarty_tpl->tpl_vars['c_fontend_template_url']->value;?>
/css/lightgallery.css" rel="stylesheet">
<?php echo '<script'; ?>
 defer src="<?php echo $_smarty_tpl->tpl_vars['c_fontend_template_url']->value;?>
/js/lightgallery-all.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 defer src="<?php echo $_smarty_tpl->tpl_vars['c_fontend_template_url']->value;?>
/js/jquery.mousewheel.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 async="" type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['c_fontend_template_url']->value;?>
/js/sticky_kit.js"><?php echo '</script'; ?>
>
<style>
.youtube_image img{
    display: none;
}
@media only screen and (max-width: 550px) {
    .lightslider{
        height: 350px !important;
    }
}
@media only screen and (max-width: 500px) {
    .lightslider{
        height: 300px !important;
    }
}
@media only screen and (max-width: 400px) {
    .lightslider{
        height: 250px !important;
    }
}

#theImg {
    position: absolute;
    top: 31%;
    left: 7.9%;
    height: 40%;
    width: 8%;
}
</style>
<?php echo '<script'; ?>
>
     $(document).ready(function() {
        sticky();
        $('.lightslider').lightGallery();
        $('.lightslider').lightSlider({
            gallery:true,
            item:1,
            thumbItem:4,
            slideMargin: 0,
            speed:400,
            auto:false,
            loop:true,
            onSliderLoad: function() {
                $('.lightslider').removeClass('cS-hidden');
                $('.youtube_image img').addClass('cS-hidden');
                
            }  
        });
        
    });
    function sticky(offset_top){
        if(typeof offset_top == 'undefined'){
            offset_top = 10;
        }    
        if($('.dsk-sticky').length){     
            
            $('.dsk-sticky').stick_in_parent({
                parent: ".stream-index",
                spacer: '.dsk-sticky-wrapper',
                offset_top: offset_top
            });
        }
    }
    
    
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
                                        <div style="display:none;" id="video1">
                                            <video class="lg-video-object lg-html5" controls preload="none" data-poster="<?php echo $_smarty_tpl->tpl_vars['post_info']->value['image'];?>
">
                                                <source src="<?php echo $_smarty_tpl->tpl_vars['post_info']->value['video'];?>
" type="video/mp4">
                                                Your browser does not support HTML5 video.
                                            </video>
                                        </div>
                                        <ul class="gallery lightslider list-unstyled">
                                            <?php if (!empty($_smarty_tpl->tpl_vars['post_info']->value['youtube'])) {?>
                                            <li class="col-xs-6 col-sm-4 col-md-3 youtube_image" key="<?php echo $_smarty_tpl->tpl_vars['myKey']->value;?>
" data-thumb="<?php echo timthumb_url($_smarty_tpl->tpl_vars['post_info']->value['image'],600,400,FALSE);?>
" data-sub-html="<h4>Nội Thất Zip</h4>" data-poster="<?php echo $_smarty_tpl->tpl_vars['post_info']->value['image'];?>
" data-html="#video1"  >
                                                <img  class="lazyload" data-src="<?php echo timthumb_url($_smarty_tpl->tpl_vars['post_info']->value['image'],600,400,FALSE);?>
" alt=""/> 
                                                <iframe width="585" height="400" src="<?php echo $_smarty_tpl->tpl_vars['post_info']->value['youtube'];?>
" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </li>
                                            <?php }?>

                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['other_images']->value, 'other_image', false, 'myKey');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['myKey']->value => $_smarty_tpl->tpl_vars['other_image']->value) {
?>
                                                <li class="col-xs-6 col-sm-4 col-md-3"  key="<?php echo $_smarty_tpl->tpl_vars['myKey']->value;?>
" data-thumb="<?php echo timthumb_url($_smarty_tpl->tpl_vars['other_image']->value['src'],600,400,FALSE);?>
" data-sub-html="<h4>Nội Thất Zip</h4>" data-src="<?php echo timthumb_url($_smarty_tpl->tpl_vars['other_image']->value['src'],600,400,FALSE);?>
">
                                                    <img width="600" height="400" src="<?php echo timthumb_url($_smarty_tpl->tpl_vars['other_image']->value['src'],600,400,FALSE);?>
" alt="" class="" /> 
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

                                                <div class="single-sale-price">
                                                    <span class="sale-price-label">Giá : </span>
                                                    <span class="sale-price-value"><?php echo $_smarty_tpl->tpl_vars['g_functions']->value->num_to_price($_smarty_tpl->tpl_vars['post_info']->value['gia']);?>
 đ</span>
                                                </div>
                                                
                                                <div class="single-price">
                                                   
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
                                                <span class="color-label">Màu sắc: </span>
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

                                                </span>
                                            </div>
                                           
                                        </div>
                                        <span class="clear"></span>
                                        <div class="single-des">
                                            <!--<?php echo $_smarty_tpl->tpl_vars['post_info']->value['description'];?>
-->
                                        </div>
                                        <span class="clear"></span>
                                        <div class="buy-product">
                                            <!--<span class="add-to-cart" price="<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->price_to_num($_smarty_tpl->tpl_vars['real_price']->value);?>
" particular="<?php echo $_smarty_tpl->tpl_vars['post_info']->value['id'];?>
">Đặt hàng</span>-->
                                        </div>
                                        <!--<div class="more-detail">-->
                                        <!--    <div class="block-html-content">-->
                                        <!--        <p class="btn btn-success" style="padding: 10px 0px;background-color: #009f4b;color: #fff;display: inline-block;cursor: pointer;text-transform: uppercase;padding-left: 15px;padding-right: 15px;border-radius: 5px;margin: 10px 0;">Đặt Tư Vấn!</p>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        
                                        <!--<?php if (!$_smarty_tpl->tpl_vars['g_functions']->value->wp_is_mobile()) {?>-->
                                        <!--    <span class="add-to-cart block " price="<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->price_to_num($_smarty_tpl->tpl_vars['real_price']->value);?>
" particular="<?php echo $_smarty_tpl->tpl_vars['post_info']->value['id'];?>
">Đặt hàng</span>-->
                                        <!--<?php }?>-->
                                        
                                        <div>
                                            <form id="order-form-marketing">
                                                <div class="v-col-lg-8 fl v-col-lg-8-mb">
                                                    <input type="number" id="order-phone"  class="text-mtt" placeholder="Nhập Số Điện Thoại" required />
                                                </div>
                                                <div class="order-action fr v-col-lg-4 v-col-lg-4-mb">
                                                    <button type="submit" class="submit btn-mtt" id="submit-order-marketing" > 
                                                        <i class="fa fa-user"></i>  Nhận Tư Vấn
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <p id="order-desc-time-tv" class="hidden">10</p>
                                        <div class="show-text-marketting hidden"><i> Số điện thoại của bạn đã được gửi đi thành công. Zip sẽ liên hệ đến bạn ngay!</i> </div>
                                        
                                        
                                        <?php if ($_smarty_tpl->tpl_vars['g_functions']->value->wp_is_mobile()) {?>
                                            <!--<div class="more-detail">-->
                                            <!--    <div class="form-content">-->
                                            <!--        <div class="block-html-content">-->
                                            <!--            <p style="padding: 0px;margin:0px;">Nhập thông tin để nhận vị trí Showroom gần nhất!</p>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                        <?php }?>
                                        
                                        <div class="buy-product">
                                            <span class="add-to-cart" price="<?php echo $_smarty_tpl->tpl_vars['g_functions']->value->price_to_num($_smarty_tpl->tpl_vars['real_price']->value);?>
" particular="<?php echo $_smarty_tpl->tpl_vars['post_info']->value['id'];?>
">Đặt hàng</span>
                                        </div>
                                        
                                        <div style="color: #339f4b;font-weight: 700;">
                                            Liên hệ tư vấn: 
                                            <ul style="padding-left: 20px;">
                                                <li>
                                                    <a href="tel:0913996633" style="text-decoration: none;">
                                            			<strong> HCM: </strong><span class="text-hotline">0913.99.66.33 </span>
                                            		</a>
                                                </li>
                                                <li>
                                                    <a href="tel:0969545511" style="text-decoration: none;">
                                            			<strong> HN: </strong><span class="text-hotline">0969.545.511 </span>
                                            		</a>
                                                </li>
                                            </ul>
                                            
                                        </div>
                                        
                            </div> 
                        </div>
                    </div> 
                
                    <div class="hr"></div>
                    
                    <div id="post-cols" class="clearfix stream-index">
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
                                             <div id="post-content" >
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
                         <?php if (!$_smarty_tpl->tpl_vars['g_functions']->value->wp_is_mobile()) {?>
                        <div class="fr v-col-lg-3 demo-form">
                            <div class=" dsk-sticky-wrapper">
                                <div class="dsk-sticky" style="background-color: rgb(0, 159, 75);border-radius: 25px;" >
                                    <h4 style="text-align: center; padding-top: 10px;">Nhập thông tin để nhận vị trí Showroom gần nhất</h4>
                                    <div style="background-color: white;">
                                        <form id="order-form-tv" style="padding: 0 10px;background-color: white;">
                                            <input type="text" id="order-name-tv" class="text css-form" placeholder="Họ tên*" required />
                                            <input type="text" id="order-phone-tv"  class="text css-form" placeholder="Điện thoại*" required />
                                            <input type="text" id="order-place-tv"  class="text css-form" placeholder="Địa chỉ*" required/>
                                            <input type="hidden" id="order-email-tv"  class="text css-form" placeholder="Email"/>
                                            <textarea id="other_info_tv" class="v-tx-none v-xs-none css-form" placeholder="Thông tin thêm"></textarea>
                                            <span class="clear"></span>
                                            <div class="order-action" style="padding: 0 95px;">
                                               <input type="submit" class="submit" value="Gửi" id="submit-order-tv" />
                                            </div>
                                        </form>
                                    </div>
                                    <p id="order-desc-time-tv" class="hidden">10</p>
                                    <div class="show-text"></div>
                                </div>
                            </div>
                        </div>
                        <?php }?>
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
