<?php
    
    if(!defined('SECURE_CHECK')) die('Invalid to include');
    
    if(!user_can('general')) die();
    
    if(isset($_POST['submit']))
    {
        $g_form_success = 'Save Success';
    }
	$g_page_content['title'] = 'Developer';
    
    $default_value = array();
    
    for($i=1;$i<=4;$i++)
    {    
        $default_value['dsbv' . $i . '_box'] = get_config('dsbv' . $i . '_box');
    }
    
    $i = 1;
    while(file_exists( PATH_ROOT . '/tpl/tpl/box/box' . $i . '.tpl' ))
    {
        $default_value['box' . $i . '_thumbnail_width'] = get_config('box' . $i . '_thumbnail_width');
        $default_value['box' . $i . '_thumbnail_height'] = get_config('box' . $i . '_thumbnail_height');
        $default_value['box' . $i . '_class'] = get_config('box' . $i . '_class');
        $i++;
    }
    
    $default_value['web_responsive'] = get_config('web_responsive');
    $default_value['web_status'] = get_config('web_status');
    
    
                         
    
    if(isset($_POST['submit']))
    {
        $default_value = $_POST;
        foreach($_POST as $k=>$v)
        {
            update_config($k, $v);
        }
    }
     
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
<link rel="stylesheet" href="<?php echo CDN_DOMAIN ?>/admin/css/developer.css" />
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
                    <div class="option-type-developer box">
                        <h2 class="title">Các box mặc định cho DS bài viết</h2>
                        <?php
                        for($i=1;$i<=4;$i++)
                        {    
                        ?>
                        <div class="developer-item">
                            <label>DS bài viết <?php echo $i ?></label>
                            <div class="developer-item-content">
                                <select name="dsbv<?php echo $i ?>_box">
                                <option value="">box<?php echo $i ?> trong template</option>
                                <?php 
                                $j = 1;
                                while(file_exists( PATH_ROOT . '/tpl/tpl/box/box' . $j . '.tpl' ))
                                {
                                     ?>
                                     <option <?php if( $default_value['dsbv' . $i . '_box'] == 'box' . $j ) echo ' selected ' ?> value="box<?php echo $j ?>">box<?php echo $j ?></option>
                                     <?php
                                     $j++;
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                        <?php
                        }
                        ?>                        
                    </div>
                    <div class="option-type-developer box">
                        <h2 class="title">Tham số cho các box</h2>
                        <?php 
                        $i = 1;
                        while(file_exists( PATH_ROOT . '/tpl/tpl/box/box' . $i . '.tpl' ))
                        {
                            ?>
                            <div class="developer-item">
                                <label>box<?php echo $i ?>.tpl</label>
                                <div class="developer-item-content">
                                    <input name="box<?php echo $i ?>_thumbnail_width" value="<?php echo $default_value['box'. $i . '_thumbnail_width'] ?>" placeholder="Chiều rộng ảnh thumbnail" /> (px)
                                    <input name="box<?php echo $i ?>_thumbnail_height" value="<?php echo $default_value['box'. $i . '_thumbnail_height'] ?>" placeholder="Chiều cao ảnh thumbnail" /> (px)
                                    <br />
                                    <input style="min-width: 375px;" name="box<?php echo $i ?>_class" value="<?php echo $default_value['box'. $i . '_class'] ?>" placeholder="Box class" />
                                    <span class="clear"></span>
                                </div>
                                <span class="clear"></span>
                            </div>
                            <?php
                            $i++;
                        }
                        ?>
                    </div>
                     
                    <div class="option-type-developer box">
                        <h2 class="title">Web Responsive</h2>
                        <select name="web_responsive">
                            <option <?php if( $default_value['web_responsive'] == '1' ) echo ' selected ' ?> value="1">Yes</option>
                            <option <?php if( $default_value['web_responsive'] == '0' ) echo ' selected ' ?> value="0">No</option>
                        </select>
                    </div>
                    
                    <div class="option-type-developer box">
                        <h2 class="title">Trạng thái</h2>
                        <select name="web_status">
                            <option <?php if( $default_value['web_status'] == 'active' ) echo ' selected ' ?> value="active">Hoạt động</option>
                            <option <?php if( $default_value['web_status'] == 'locked' ) echo ' selected ' ?> value="locked">Khóa</option>
                        </select>
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