{include file='../header.tpl'}

{if empty($post_info.other_images) }

    {assign var="other_colors" value=[]}

{else}

    {assign var="other_colors" value=json_decode($post_info.other_images, TRUE)}

{/if}



{if !empty($post_info.color1) }

    {assign var="other_images" value=json_decode($post_info.color1, TRUE)}

 

{else if !empty($post_info.color2)}

    {assign var="other_images" value=json_decode($post_info.color2, TRUE)}

{else if !empty($post_info.color3)}

    {assign var="other_images" value=json_decode($post_info.color3, TRUE)}

{else}

    {assign var="other_images" value=[]}

{/if}



<!--{if !empty($post_info.color1) }-->

<!--    {$count++}-->

<!--{/if}-->

<!--{if !empty($post_info.color2)}-->

<!--    {$count++}-->

<!--{/if}-->

<!--{if !empty($post_info.color3)}-->

<!--    {$count++}-->

<!--{/if}-->

<script defer src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>

<script defer src="{$c_cdn_domain}/blocks/Slide/ListSlide/Light/src/js/lightsliderproduct.js?v=1"></script>

<link defer rel="stylesheet" href="{$c_cdn_domain}/blocks/Slide/ListSlide/Light/src/css/lightslider.css" type="text/css" media="screen" />

<link defer href="{$c_fontend_template_url}/css/lightgallery.css" rel="stylesheet">

<script defer src="{$c_fontend_template_url}/js/lightgallery-all.min.js"></script>

<script defer src="{$c_fontend_template_url}/js/jquery.mousewheel.min.js"></script>

<script async="" type="text/javascript" src="{$c_fontend_template_url}/js/sticky_kit.js"></script>

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

<script>

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

    

    

</script>



   

<div id="bread-crumb" class="clearfix v-wrap-full">

    {$g_functions->display_bread_crumb()}

</div>



<main id="main-content">

    <div id="site-cotnent-inner" class="v-wrap-full clearfix">

        <div class=" " id="col1">

            <div class="col1-content">

                <span class="clear"></span>

                    

                    <div id="general-info" class="clearfix" >

                        <div class="general-info-col general-info-col1 fl v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-12 v-col-tx-12">

                            <div class="general-info-col-inner general-info-col1-inner">

                                {if !empty($post_info.color1) }

                                    {assign var="other_images" value=json_decode($post_info.color1, TRUE)}

                                    <div class=" gallery-wrap gallery-1 active">

                                        <div style="display:none;" id="video1">

                                            <video class="lg-video-object lg-html5" controls preload="none" data-poster="{$post_info.image}">

                                                <source src="{$post_info.video}" type="video/mp4">

                                                Your browser does not support HTML5 video.

                                            </video>

                                        </div>

                                        <ul class="gallery lightslider list-unstyled">

                                            {if !empty($post_info.youtube)}

                                            <li class="col-xs-6 col-sm-4 col-md-3 youtube_image" key="{$myKey}" data-thumb="{timthumb_url($post_info.image, 600, 400, FALSE)}" data-sub-html="<h4>Nội Thất Zip</h4>" data-poster="{$post_info.image}" data-html="#video1"  >

                                                <img  class="lazyload" data-src="{timthumb_url($post_info.image, 600, 400, FALSE)}" alt=""/> 

                                                <iframe width="585" height="400" src="{$post_info.youtube}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                            </li>

                                            {/if}



                                            {foreach from=$other_images item = $other_image key=myKey}

                                                <li class="col-xs-6 col-sm-4 col-md-3"  key="{$myKey}" data-thumb="{timthumb_url($other_image.src, 600, 400, FALSE)}" data-sub-html="<h4>Nội Thất Zip</h4>" data-src="{timthumb_url($other_image.src, 600, 400, FALSE)}">

                                                    <img width="600" height="400" src="{timthumb_url($other_image.src, 600, 400, FALSE)}" alt="" class="" /> 

                                                </li>

                                            {/foreach}

                                        </ul>

                                    </div>

                                {/if}

                                

                                {if !empty($post_info.color2) }

                                    {assign var="other_images" value=json_decode($post_info.color2, TRUE)}

                                    <div class="gallery-wrap gallery-2 active opacityWrap">

                                    <ul class="gallery lightslider list-unstyled">

                                        {foreach from=$other_images item = $other_image key=myKey}

                                            <li key="{$myKey}" data-thumb="{timthumb_url($other_image.src, 600, 400, FALSE)}">

                                                <img width="600" height="400" src="{timthumb_url($other_image.src, 600, 400, FALSE)}" alt="" /> 

                                            </li>

                                        {/foreach}

                                    </ul>

                                </div>

                                {/if}

                                

                                {if !empty($post_info.color3) }

                                    {assign var="other_images" value=json_decode($post_info.color3, TRUE)}

                                    <div class="gallery-wrap gallery-3 active opacityWrap">

                                    <ul class="gallery lightslider list-unstyled">

                                        {foreach from=$other_images item = $other_image key=myKey}

                                            <li key="{$myKey}" data-thumb="{timthumb_url($other_image.src, 600, 400, FALSE)}">

                                                <img width="600" height="400" src="{timthumb_url($other_image.src, 600, 400, FALSE)}" alt="" /> 

                                            </li>

                                        {/foreach}

                                    </ul>

                                </div>

                                {/if}

                                

                            </div>

                        </div>

                        <div class="general-info-col general-info-col2 fl v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-12 v-col-tx-12">

                            <div class="general-info-col-inner general-info-col2-inner">

                                    <h1 id="page-h1" class="block-title">{$post_info.title}</h1>

                                    

                                        <span class="clear"></span>

                                        <span class="ma-sp">

                                            {if !empty($post_info.masp) }

                                            <div class="ma-sp-inner">

                                                <span class="masp-label">Mã sản phẩm : </span>

                                                <span class="ma-sp-text">{$post_info.masp}</span>

                                            </div>

                                            {/if}

                                        </span>

                                        

                                         <span class="clear"></span>

                                        <div id="single-order" class="clearfix" >

                                            {if !empty($post_info.recent_km)}

                                                {$real_price =floor(($post_info.gia - ($post_info.recent_km/100 * $post_info.gia))/1000)*1000 }

                                                {$percent = 100 * ($post_info.gia - $real_price) / $post_info.gia }

                                                {$post_info.gia_km = $real_price}

                                                <span class="sale-percent">-  {$g_functions->floor($percent) }%</span>



                                                <div class="single-sale-price">

                                                    <span class="sale-price-label">Giá : </span>

                                                    <span class="sale-price-value">{$g_functions->num_to_price($post_info.gia)} đ</span>

                                                </div>

                                                

                                                <div class="single-price">

                                                   

                                                    <span class="price-label">Giá KM: </span>

                                                    

                                                    <span class="price-value">{$g_functions->num_to_price($real_price)} đ</span>

                                                    

                                                </div>

                                            {else}

                                                {$real_price = $post_info.gia}

            

                                                <div class="single-price fl v-col-lg-6 ">

                                                    <span class="price-label">Giá : </span>

                                                    <span class="price-value">{$g_functions->num_to_price($real_price)} đ</span>

                                                </div>

                                            {/if}

                                            

                                                                            

                                        </div>

                                        <span class="clear"></span>

                                

                                        <div class="color-sp">

                            

                                            <div class="color-sp-inner">

                                                <span class="color-label">Màu sắc: </span>

                                                <span class="color-sp-text">

                                                    {for $i=0 to $other_colors|count-1}

                                                        <li key="{$i+1}" id="mausac{$i+1}" data-thumb="{timthumb_url($other_colors[$i].src, 100, 100, FALSE)}">

                                                            <img width="50" height="50" src="{timthumb_url($other_colors[$i].src, 100, 100, FALSE)}" alt="" /> 

                                                        </li>

                                                    {/for}

                                                </span>

                                            </div>

                                           

                                        </div>

                                        <span class="clear"></span>

                                        <div class="single-des">

                                            <!--{$post_info.description}-->

                                        </div>

                                        <span class="clear"></span>

                                        <div class="buy-product">

                                            <!--<span class="add-to-cart" price="{$g_functions->price_to_num($real_price)}" particular="{$post_info.id}">Đặt hàng</span>-->

                                        </div>

                                        <!--<div class="more-detail">-->

                                        <!--    <div class="block-html-content">-->

                                        <!--        <p class="btn btn-success" style="padding: 10px 0px;background-color: #009f4b;color: #fff;display: inline-block;cursor: pointer;text-transform: uppercase;padding-left: 15px;padding-right: 15px;border-radius: 5px;margin: 10px 0;">Đặt Tư Vấn!</p>-->

                                        <!--    </div>-->

                                        <!--</div>-->

                                        

                                        <!--{if !$g_functions->wp_is_mobile()}-->

                                        <!--    <span class="add-to-cart block " price="{$g_functions->price_to_num($real_price)}" particular="{$post_info.id}">Đặt hàng</span>-->

                                        <!--{/if}-->

                                        

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

                                        

                                        

                                        {if $g_functions->wp_is_mobile()}

                                            <!--<div class="more-detail">-->

                                            <!--    <div class="form-content">-->

                                            <!--        <div class="block-html-content">-->

                                            <!--            <p style="padding: 0px;margin:0px;">Nhập thông tin để nhận vị trí Showroom gần nhất!</p>-->

                                            <!--        </div>-->

                                            <!--    </div>-->

                                            <!--</div>-->

                                        {/if}

                                        

                                        <div class="buy-product">

                                            <span class="add-to-cart" price="{$g_functions->price_to_num($real_price)}" particular="{$post_info.id}">Đặt hàng</span>

                                        </div>

                                        

                                        <div style="color: #339f4b;font-weight: 700;">

                                            Liên hệ tư vấn: 

                                            <ul style="padding-left: 20px;">

                                                <li>

                                                    <a href="tel:0913996633" style="text-decoration: none;">

                                            			<strong> Sale 1: </strong><span class="text-hotline">0913.99.66.33 </span>

                                            		</a>

                                                </li>

                                                <li>

                                                    <a href="tel:0969545511" style="text-decoration: none;">

                                            			<strong> Sale 2: </strong><span class="text-hotline">0912.99.66.33 </span>

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

                                                {$post_info.content}

                                                <span class="clear"></span>

             

                                            </div>

                                            <div class="expend-des-bottom"></div>



                                          </div>

                                       </div>

                                       <div class="v-tabs-content-item" >

                                             <!--{$g_views_BlockArea->display_area('thong-so')}-->

                                             {$post_info.description}

                                          </div>

                                       

                                       

                                    </div>

                            

                                </div>

                                <span class="clear"></span>

                                

                        </div>

                         {if !$g_functions->wp_is_mobile()}

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

                        {/if}

                    </div>

                    <div class="hr hr-2"></div>

            </div>

        </div>

        <span class="clear"></span>

        <div class="more-detail">

            <div class="form-content">

                {$g_views_BlockArea->display_area('more-detail')}

            </div>

        </div>

            

        <span class="clear"></span>

        <div class="relative-posts">

            <div class="block-title">Sản phẩm liên quan</div>

            <div class="block-content">

                {$posts = $g_functions->get_relative_posts(['posts_per_page'=> 4, 'filter_by'=>'category', 'order'=> 'ORDER BY time_update DESC'])}

                {include file='../box2.tpl'}

            </div>

        </div>

        <span class="clear"></span>

        

    </div>

</main>



{include file="../footer.tpl"}