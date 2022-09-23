<!--<div class="near-footer v-wrap-full">-->
<!--    {$g_views_BlockArea->display_area('near-footer')} -->
<!--</div>-->
<div id='fb-root' > </div>

<div class="fb-test ">
    <a class="fb-test-link" href="http://m.me/noithatzipvietnam"><img src="https://noithatzip.com/uploads/logo_fb.png" width="65px" height="65px"></a>
</div>
<!-- {get_config('admin_ecommerce_phone_show')} -->

{include file="$c_cdn_tpl_tpl_path/inc/footer/footer-3.tpl"}

<span class="go-to-top"><i class="fa fa-arrow-up"></i></span>
  
{$g_functions->display_extension_by_position('before_close_body')}
<div class="hotline-phone-ring-wrap">
	<div class="hotline-phone-ring">
		<div class="hotline-phone-ring-circle"></div>
		<div class="hotline-phone-ring-circle-fill"></div>
		<div class="hotline-phone-ring-img-circle">
		<a href="tel:{get_config('admin_ecommerce_phone_show')}" class="pps-btn-img">
			<img src="https://noithatzip.com/uploads/logo/icon-call-nh.png" alt="Gọi điện thoại" width="50">
		</a>
		</div>
	</div>
	<div class="hotline-bar">
		<a href="tel:0912996633">
			<span class="text-hotline">{get_config('admin_ecommerce_phone_show')}</span>
		</a>
	</div>
</div>

</body>
</html>