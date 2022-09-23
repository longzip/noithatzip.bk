<!--<div class="near-footer v-wrap-full">-->
<!--    {$g_views_BlockArea->display_area('near-footer')} -->
<!--</div>-->
<div id='fb-root' > </div>



<script>

(function(d, s, id) {     
    var js, fjs = d.getElementsByTagName(s)[0];     
    js = d.createElement(s); js.id = id;     
    js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';     
    fjs.parentNode.insertBefore(js, fjs);   
}(document, 'script', 'facebook-jssdk'));
</script>   
<div class='fb-customerchat' greeting_dialog_display="fade" 
        greeting_dialog_delay="60" page_id='603080049768085' theme_color='#009e4a' logged_in_greeting= 'Xin chào, tôi có thể hổ trợ gì cho bạn không?' logged_out_greeting = 'Xin chào, tôi có thể hổ trợ gì cho bạn không?' > </div>

{include file="$c_cdn_tpl_tpl_path/inc/footer/footer-3.tpl"}

<span class="go-to-top"><i class="fa fa-arrow-up"></i></span>
  
{$g_functions->display_extension_by_position('before_close_body')}

</body>
</html>