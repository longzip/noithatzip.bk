{include file='../header.tpl'}
<link rel="stylesheet" type="text/css" href="{$c_fontend_template_url}/css/showRoom.css?v={$v}" media="all"/>
{if empty($post_info.others_img) }
    {assign var="other_images" value=[]}
{else}
    {assign var="other_images" value=json_decode($post_info.others_img, TRUE)}
{/if}

<div class="v-full-width wrap-dieu-huong" id="breadcrumbs">
    <div class="dieu-huong v-wrap-full bread-crumb">
        {$g_functions->display_bread_crumb()}
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
										<img alt="{$post_info.title}" title="{$post_info.title}" src="{$g_functions->timthumb_url($post_info.image, 600, 400)}" id="main-image" />
								</div>
								<div class="showroom-inner other-images fl">
									<div class="other-image">
										<img large_src="{$g_functions->timthumb_url($post_info.image, 600, 400,FALSE)}" class="active" alt="{$post_info.title}" src="{$g_functions->timthumb_url($post_info.image, 150, 100)}" />
									</div>
									{foreach $other_images as $other_image}
											<div class="other-image">
												<img large_src="{$g_functions->timthumb_url($other_image.src, 600, 400,FALSE)}" src="{$g_functions->timthumb_url($other_image.src, 150, 100)}" />
											</div>
									{/foreach}
								</div>
								<span class="clear"></span>
							</div>
							 
						</div>
						 
						<div id="single-info" class="showRoomItem general-info2 v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-12 v-col-tx-12 v-lg-float-right  v-md-float-right v-sm-float-right v-xs-float-none v-tx-float-none">
							<h1 id="single-h1">{$post_info.title}</h1>
							
							<div class="address showRoomOther showRoomOtherPlace">
							    <i class="fa fa-map-marker"></i>
							    {if empty($post_info.showroom_dia_chi)}
                                    <span>Địa chỉ chưa được cập nhật </span>
                                {else}
                                    {$post_info.showroom_dia_chi}
                                {/if}
							</div>
							<div class="google-map showRoomOther showRoomOtherMap">
							    <i class="fa fa-map-marker"></i>
							    {if empty($post_info.showroom_map)}
                                    <span>Bản đồ chưa được cập nhật </span>
                                {else}
                                    <a href={$post_info.showroom_map}>Chỉ đường cho tôi</a>
                                {/if}
							</div>
							<div class="phone showRoomOther showRoomOtherPhone">
							    <i class="fa fa-phone"></i>
							    {if empty($post_info.showroom_phone)}
                                    <span>Số điện thoại chưa được cập nhật </span>
                                {else}
                                    <a href={$post_info.showroom_phone}>{$post_info.showroom_phone}</a>
                                {/if}
							</div>
							<div class="single-des">
							    {if empty($post_info.description)}
                                    {$g_functions->the_excerpt_max_charlength(strip_tags($post_info.content), 300)}
                                {else}
                                    {$post_info.description}
                                {/if}
 
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
{include file='../footer.tpl'}
