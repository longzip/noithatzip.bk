<?php
    if(!defined('SECURE_CHECK')) die('Invalid to include');  
    if(!user_can('editor')) die();
	$g_page_content['title'] = 'Editor';
    
    if(SITE_URL != 'https://code.zland.vn') die('Domain k hop le');
?>

<?php
	include 'header.php';
?>
<style type="text/css" media="screen">
    #editor { 
        position: absolute;
        top: 80px;
        right: 0;
        bottom: 0;
        left: 0;
        width: 97%;
        padding: 10px 0;
        min-height: 500px;
    }
    input#path_name {
        border: 1px solid #e8e5e5;
        padding: 6px;
        border-radius: 5px;
    }
</style>
<script lang="javascript" src="<?php echo CDN_DOMAIN . '/admin/js/editor.js?v=' . FRONT_END_VERSION  ?>"></script>
<script lang="javascript" src="<?php echo CDN_DOMAIN . '/admin/js/editor-upload.js?v=' .FRONT_END_VERSION ?>"></script>

<script type="text/javascript">
  
  function confirmExit()
  {
    return "Bạn có thật sự muốn thoát ? ";
  }
  
  $(document).ready(function(){
	
	window.onbeforeunload = null;
    
    $("body").keyup(function(){
		window.onbeforeunload = confirmExit;
	});
    
  });
 
</script>

<link type="text/css" rel="stylesheet" href="<?php echo CDN_DOMAIN ?>/admin/css/editor.css?v=<?php echo FRONT_END_VERSION ?>" />

<?php 
    if(isset($_GET['dir']))
    {
        $current_dir = urldecode($_GET['dir']);
    }
    else
    {
        $current_dir = '';
    }
    
?> 

<div id="content" class="container clearfix">
    <div id="main-content" class="clearfix  wrap-editor ">
        <div class="" id="tpl">
            <div class="relative   fl edit-editor v-col-lg-9 v-col-md-9 v-col-sm-8 v-col-xs-7 v-col-tx-6">
                <div class="clear clearfix">
                    <div class="fl current-path  "></div>
                    <div class="fr" id="unminify"><i class="fa fa-file-text-o"></i>Unminify</div>
                </div>&nbsp;
                <div id="editor-nav">
                     
                </div>
                <div id="editor"></div>
                <textarea id="editor-textarea"></textarea>
                
                 
            </div>
            <div class="fl project-file   v-col-lg-3 v-col-md-3 v-col-sm-4 v-col-xs-5 v-col-tx-6">
                <div id="auto-save">
                    Tự động lưu <select id="auto-save-input"><option value="0">Không</option><option value="1">Có</option></select>
                    &nbsp; &nbsp; Nén file <select id="mini-file"><option value="0">Không</option><option value="1">Có</option></select>
                </div>
                <div class="file-paths">
                <?php display_dir_content(PATH_ROOT . '/tpl/tpl') ?>
                </div>
                
                <div class="col-xs-6 none " id="upload-drop-area"> 
                    <input class="none" multiple="multiple" id="hcv_upload_button" dir_upload="" name="userfile[]" type="file">
                    <input class="btn btn-info" type="button" value="Chọn ảnh từ máy tính" id="virtual_select_file"><br>
                    <p style="  color: #7B7B7B;margin-top: 15px;">Hoặc kéo thả tệp vào đây</p>
                </div>
                
            </div>
            <span class="clear"></span>
            <div class="view-backup-file v-col-lg-9 v-col-md-9 v-col-sm-8 v-col-xs-7 ">
                <button class="view-backup">Xem các bản backup</button>
                <input value="" id="path_name" />
                <div class="view-backup-content"></div>
            </div>
                <span class="clear"></span>
        </div>
    </div>
    <span class="clear"></span>
</div>
<span class="clear"></span>
<i class="fa fa-caret-left toogle-huong-dan"></i>
<i class="fa fa-caret-right toogle-backup"></i>
<div id="huong-dan">
    <h2>Biến hay dùng</h2>
     <div class="houng-dan-item">
        <div class="houng-dan-item-title">
            URL website : 
        </div>
        <div class="houng-dan-item-content">
            <input value="{$c_site_url}"  spellcheck="false" /> 
        </div>
    </div>
    
     <div class="houng-dan-item">
        <div class="houng-dan-item-title">
            URL CDN : 
        </div>
        <div class="houng-dan-item-content">
            <input value="{$c_cdn_domain}" spellcheck="false" />
            
        </div>
    </div>
    
    <div class="houng-dan-item">
        <div class="houng-dan-item-title">
            URL template : 
        </div>
        <div class="houng-dan-item-content">
            <input value="{$c_fontend_template_url}"  spellcheck="false" />
            
        </div>
    </div>
    <br />
    <hr /><br />
    <h2>Hàm hay dùng</h2>
    <div class="houng-dan-item">
        <div class="houng-dan-item-title">
            Hiển thị block area : 
        </div>
        <div class="houng-dan-item-content">
            <input value="{$g_views_BlockArea->display_area('ten_block_area')}"  spellcheck="false" />
            
        </div>
    </div>
    <div class="houng-dan-item">
        <div class="houng-dan-item-title">
            Hiển thị ghim : 
        </div>
        <div class="houng-dan-item-content">
            <input value="{$g_functions->display_edit_option_icon('ten', 'loai')}"  spellcheck="false" />
            
        </div>
    </div>
     <div class="houng-dan-item">
        <div class="houng-dan-item-title">
            Hiển thị giá trị ghim : 
        </div>
        <div class="houng-dan-item-content">
            <input value="{$g_functions->get_option('ten')}"  spellcheck="false" />
            
        </div>
    </div>
    
    <div class="houng-dan-item">
        <div class="houng-dan-item-title">
            Hiển thị form search : 
        </div>
        <div class="houng-dan-item-content">
            <input value="{$g_functions->search_form()}"  spellcheck="false" />
            
        </div>
    </div>
    
    
    <div class="houng-dan-item">
        <div class="houng-dan-item-title">
            Hiển thị breadcrumb : 
        </div>
        <div class="houng-dan-item-content">
            <input value="{$g_functions->display_bread_crumb()}"  spellcheck="false" />
            
        </div>
    </div>
    
    <div class="houng-dan-item">
        <div class="houng-dan-item-title">
            Hiển thị phân trang : 
        </div>
        <div class="houng-dan-item-content">
            <input value="{$g_functions->display_pagination()}"  spellcheck="false" />
            
        </div>
    </div>
    
    <div class="houng-dan-item">
        <div class="houng-dan-item-title">
            Lấy danh sách tin liên quan : 
        </div>
        <div class="houng-dan-item-content">
            <input value="{$posts=$g_functions->get_relative_posts()}"  spellcheck="false" />
            
        </div>
    </div>
    
    <div class="houng-dan-item">
        <div class="houng-dan-item-title">
            Hiển thị đường dẫn ảnh timthumb : 
        </div>
        <div class="houng-dan-item-content">
            <input value="{$g_functions->timthumb_url($duong_dan_anh, $chieu_rong, $chieu_cao)}"  spellcheck="false" />
        </div>
    </div>
    
    <div class="houng-dan-item">
        <div class="houng-dan-item-title">
            Hiển thị excerpt : 
        </div>
        <div class="houng-dan-item-content">
            <input value="{$g_functions->the_excerpt_max_charlength($noi_dung, $so_ky_tu)}"  spellcheck="false" />
            
        </div>
    </div>
    
    <div class="houng-dan-item">
        <div class="houng-dan-item-title">
            Hiển thị tabs : 
        </div>
        <div class="houng-dan-item-content">
            <input value="{$g_functions->block_area_tabs($id, $click_type)}"  spellcheck="false" />
            
        </div>
    </div>
    
    <div class="houng-dan-item">
        <div class="houng-dan-item-title">
            Hiển thị danh sách HTML dạng Carousel : 
        </div>
        <div class="houng-dan-item-content">
            <input value="{$g_functions->list_html_carousel($id, $carousel_param)}"  spellcheck="false" />
            
        </div>
    </div>
    
    <br />
    <hr /><br />
    <h2>CDN</h2>
    <div class="houng-dan-item">
        <div class="houng-dan-item-title">
            CDN Carousel : 
        </div>
        <div class="houng-dan-item-content">
            <input value="{$g_functions->display_carousel_cdn()}"  spellcheck="false" />
            
        </div>
    </div>
    <div class="houng-dan-item">
        <div class="houng-dan-item-title">
            SDK Facebook Javascript : 
        </div>
        <div class="houng-dan-item-content">
            <input value="{$g_functions->fb_sdk_js()}"  spellcheck="false" />
            
        </div>
    </div>
    
     <div class="houng-dan-item">
        <div class="houng-dan-item-title">
            CDN Effect and Style : 
        </div>
        <div class="houng-dan-item-content">
            <input value="{$g_functions->cdn()}"  spellcheck="false" />
            
        </div>
    </div>
    
    
    
    
    <i class="fa fa-close close-huong-dan"></i>
</div>

<div class="noti noti-success">
Lưu thành công
</div>
<script src="<?php echo CDN_DOMAIN ?>/apps/ace-builds-master/src-noconflict/ace.js?v=<?php echo FRONT_END_VERSION ?>" type="text/javascript" charset="utf-8"></script>
<script>
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.getSession().setMode("ace/mode/html"); 
    //editor.setValue(JSON.stringify(jsonDoc, null, '\t'));
</script>
<?php 
include 'footer.php';
?>