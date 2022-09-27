<?php
$default = array(
    'title'         => '',
    'title_link'    => '',
    'category'      => 0,
	'posts_per_page'	=> 9,
	'orderby'		=> 'id',
	'order'		=> 'DESC', 
    'visible_posts'     => 6
);
if(isset($temporary_setting_parameter)) $default = $temporary_setting_parameter;
?>
<form id="text_form_setting" class="block_form" block_id="0">
    <?php  display_block_setting_default($default);  ?>
	
	<div class="form-group clearfix">
        <label class="" for="name">Tổng số bài viết</label>
        
        <input class="form-control parameter" parameter="posts_per_page" type="number" value="<?php echo $default['posts_per_page'] ?>" />
    </div>
	
    <div class="form-group clearfix">
        <label class="" for="name">Số bài viết tối đa trên 1 màn hình</label>
        
        <input class="form-control parameter" parameter="visible_posts" type="number" value="<?php echo $default['visible_posts'] ?>" />
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
</form>
	
