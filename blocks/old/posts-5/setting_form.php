<?php

$parent = dirname(__FILE__);
$suffix = explode('-', $parent);
$post_block_id = $suffix[count($suffix) - 1];

$default_box = get_config('dsbv' . $post_block_id . '_box'); 



$default = array(
    'title'             => '',
    'title_link'        => '',
    'category'          => 0,
	'posts_per_page'	=> 9,
	'orderby'		    => 'id',
	'order'		        => 'DESC',
    'thumb_width'       => get_config('dsbv'. $post_block_id . '_thumbnail_width'),
    'thumb_height'      => get_config('dsbv'. $post_block_id . '_thumbnail_height'),
    'default_box'       => $default_box
);
if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;


?>

<?php 




?>

<form id="text_form_setting" class="block_form" block_id="0">

    <?php  display_block_setting_default($default);  ?>
	
	<div class="form-group clearfix">
        <label class="" for="name">Số bài viết</label>
        <input class="form-control parameter block" style="width: 100px;text-align:right" parameter="posts_per_page" type="number" value="<?php echo $default['posts_per_page'] ?>" />
    </div>
	
	
	
    <div class="form-group clearfix">
        <label class="" for="name">Chuyên mục</label>
        <?php display_categories_option('', $default['category'], 'class="form-control parameter" parameter="category"') ?>    
    </div>
	
	<div class="form-group clearfix">
        <label class="" for="name">Sắp xếp theo</label>
		<select class="form-control parameter" parameter="orderby">
			<option value="id" <?php if($default['orderby'] == 'id') echo 'selected' ?>>Ngày đăng</option>
			<option value="time_update" <?php if($default['orderby'] == 'time_update') echo 'selected' ?>>Ngày cập nhật</option>
			<option value="title" <?php if($default['orderby'] == 'title') echo 'selected' ?>>Tiêu đề</option>
			<option value="gia" <?php if($default['orderby'] == 'gia') echo 'selected' ?>>Giá</option>
			<option value="comment_count" <?php if($default['orderby'] == 'comment_count') echo 'selected' ?>>Lượt bình luận</option>
			<option value="view_count" <?php if($default['orderby'] == 'view_count') echo 'selected' ?>>Lượt xem</option>
			
		</select>
	</div>
	
	<div class="form-group clearfix">
        <label class="" for="name">Thứ tự sắp xếp</label>
		<select class="form-control parameter" parameter="order">
			<option value="ASC" <?php if($default['order'] == 'ASC') echo 'selected' ?>>Tăng dần</option>
			<option value="DESC" <?php if($default['order'] == 'DESC') echo 'selected' ?>>Giảm dần</option>
		</select>
	</div>
    
    
    <div class="view-advanced">Nâng cao</div>
    <div class="advanced none">
        <div class="form-group clearfix">
            <label class="" for="name">Kích thước ảnh đại diện</label>
    		<div class="clearfix">
    			<div class="thumb-item">
                    Chiều rộng : <input class="form-control parameter" style="width: 100px;text-align:right" parameter="thumb_width" type="number" value="<?php echo $default['thumb_width'] ?>" /> (px)
                </div>
                <div class="thumb-item">
                    Chiều cao : <input class="form-control parameter" style="width: 100px;text-align:right" parameter="thumb_height" type="number" value="<?php echo $default['thumb_height'] ?>" /> (px)
                </div>
                
                
    		</div>
    	</div>
        <span class="clear"></span>
        <div class="form-group clearfix">
            <label class="" for="name">Chọn box <span style="font-size: 10px;">( Khuyến cáo : Không tùy tiện chỉnh mục này )</span></label>
    		<select class="form-control parameter" parameter="default_box">
    			<option value="0">None</option>
                <?php 
                    $lists = scandir( PATH_ROOT . '/tpl/tpl/box' );
                    unset($lists[0], $lists[1]);
                    
                    foreach($lists as $list)
                    {
                        if( is_dir( PATH_ROOT . '/tpl/tpl/box/' . $list ) ) continue;
                        $list = str_replace('.tpl', '', $list);
                        ?>
                        <option <?php if($default_box == $list) echo ' selected ' ?> value="<?php echo $list ?>"><?php echo $list ?></option>
                        <?php
                    }
                ?>
    		</select>
        </div>
        
    </div><br /><br />
</form>
	
