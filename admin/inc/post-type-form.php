 <div class="new-thread-item box">
    <label class="block fl">Tên  post type</label>
    <input name="name" class="block text fl" value="<?php return_value('name', $default_value['name'], FALSE, TRUE) ?>" />
     <span class="clear"></span>
</div>
<span class="clear"></span>

 
 
<div class="new-thread-item box">
    <label class="">Field mặc đinh</label>
    <select name="default_field">
        <option <?php if($default_value['default_field'] == '1') echo 'selected' ?> value="1">Yes</option>
        <option  <?php if($default_value['default_field'] == '0') echo 'selected' ?>  value="0">No</option>
    </select>
</div>

<div class="new-thread-item box">
    <label class="">Default Template</label>
    <?php
        
        if(file_exists(TEMPLATE_PATH  . '/index.php') ) $t_template_path = PATH_ROOT . '/tpl/tpl/' . TEMPLATE;
        else $t_template_path = TEMPLATE_PATH;
       
        
        $a = scandir($t_template_path . '/post');
        $b = array('index.php', '.', '..');
        
        $a = array_diff($a, $b);
        
    ?>
    
    <select name="default_template">
         <?php 
             
            foreach($a as $temp_v)
            {
                $temp_v = str_replace('.php', '', $temp_v);
                $temp_v = str_replace('.tpl', '', $temp_v);
                ?>
                <option <?php if($default_value['default_template'] == $temp_v) echo 'selected ' ?> value="<?php echo $temp_v ?>"><?php echo $temp_v ?></option>
                <?php
            } 
         ?>
    </select>
    
     
</div>

 
 <div class="new-thread-item box">
    <label class="block fl">Hình ảnh</label>
     <br /><br />
 
	<div class="form-box image" id="form-image">
		<div class="form-field">
			<input style="width: 70%;" class="form-control" id="image"  value="<?php return_value('image', $default_value['image'], FALSE, FALSE) ?>" type="hidden" name="image" />&nbsp;&nbsp;
			<input type="button" value="Chọn ảnh" class="show-media-frame btn btn-info" particular="image" /><br /><br />
			
		</div>
		<img id="image_display" style="max-width: 100%;" src="<?php return_value('image', $default_value['image'], FALSE, FALSE) ?>" />
	
	  
	</div>
    		 
    	
    	<span class="clear"></span>
</div>