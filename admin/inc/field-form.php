<?php
//echo $temp_post_type['type'];
switch($temp_post_type['field_type'])
{
    case 'text' :
    {
        ?>
        

        <?php
    }
    break;
    
    case 'slug' :
    {
        ?>
        <div class="new-thread-item box">
            <label class="label block fl"><?php echo $temp_post_type['title'] ?></label>
            <input name="<?php echo $temp_post_type['name'] ?>" class="block text fl" value="<?php return_value($temp_post_type['name'], $default_value[$temp_post_type['name']], FALSE, TRUE) ?>" />
             <span class="clear"></span>
        </div>
        <span class="clear"></span>

        <?php
    }
    break;
    
    case 'html' :
    {
        ?>
        <div class="new-thread-item box">
            <label class="label block"><?php echo $temp_post_type['title'] ?></label>
            <textarea name="<?php echo $temp_post_type['name'] ?>" rows="17" class="block textarea main-content"><?php return_value($temp_post_type['name'], $default_value[$temp_post_type['name']], TRUE, TRUE) ?></textarea>
        </div>
        <br /><br />
        <?php
    }
    break;
    
    case 'image' :
    {
        ?>
        <div class="option-item new-thread-item box">
        	<div class="option-content">
        		<label class="label block" style="width:300px"><?php echo $temp_post_type['title'] ?></label><br />
        		<div class="field fl">
        			<div class="form-box image" id="form-image">
        				<div class="form-field">
        					<input style="width: 70%;" class="form-control" id="<?php echo $temp_post_type['name'] ?>"  value="<?php return_value($temp_post_type['name'], $default_value[$temp_post_type['name']], FALSE, FALSE) ?>" type="hidden" name="<?php echo $temp_post_type['name'] ?>" />&nbsp;&nbsp;
        					<input type="button" value="Chọn ảnh" class="show-media-frame btn btn-info" particular="<?php echo $temp_post_type['name'] ?>" /><br /><br />
        					
        				</div>
        				<img id="<?php echo $temp_post_type['name'] ?>_display" style="max-width: 100%;" src="<?php return_value($temp_post_type['name'], $default_value[$temp_post_type['name']], FALSE, FALSE) ?>" />
        			
        			  
        			</div>
        			
        		</div>
        		
        		<span class="clear"></span>
        	</div>
        </div>
        <?php
    }
    break;
    
    
    case 'textarea' :
    {
        ?>
        <div class="new-thread-item box">
        	<label class="label block" style="width:270px;"><?php echo $temp_post_type['title'] ?></label>
        	<textarea style="width:100%" name="<?php echo $temp_post_type['name'] ?>" rows="5" class="block textarea"><?php return_value($temp_post_type['name'], $default_value[$temp_post_type['name']], FALSE, FALSE) ?></textarea>
        </div>
        <?php
    }
    break;
    
    case 'tags' :
    {
        ?>
        <div class="new-thread-item box">
            <label class="label block">TAG</label>
            <span class="clear"></span>
            <span class="clear"></span>
        </div>
        <?php
    }
    break;
    
    case 'categories' :
    {
        ?>
        <div class="new-thread-item box">
		<label class="label block"><?php echo $temp_post_type['title'] ?></label>
		<?php
			$sub_count = 0;
			if(!function_exists('display_forum_checkbox'))	
            { 
    			function display_forum_checkbox($forum, $selected = array(), $field_name = 'category')
    			{
    				
    				
    				global $sub_count;
    				?>
    					<div class="forum">
    						<div class="forum-detail">
    							<label class="forum-label"><input name="category[]" type="checkbox" <?php if(in_array($forum['id'], $selected)) echo ' checked'; ?>  value="<?php echo $forum['id'] ?>" /><?php echo $forum['title'] ?></label>
    							
    							
    						</div>
    					
    					 <?php 
    						$sub_forums = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=' . $forum['id'] . ' ORDER BY stt ASC');
    						if(!empty($sub_forums))
    						{
    							$sub_count++;
    							?>
    							<div class="sub-forum sub-forum-<?php echo $sub_count ?>">
    							<?php
    							foreach($sub_forums as $s_k=>$s_v)
    							{
    								display_forum_checkbox($s_v, $selected);
    							}
    							?>
    							</div>
    							<?php
    						}
    						
    					   ?>
    					   </div>
    				
    				<?php
    			} 
            }
			$forums = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=0');
			$sub_count = 0;
			foreach($forums as $forum)
			{
				
				?>
				<div class="forum-item">
					<?php display_forum_checkbox($forum, $default_value['categories']) ?>
				</div>
				<?php
			}
		?>
		
		<span class="clear"></span>
	</div>
        <?php
    }
    break;
    
    case 'select' :
    {
        ?>
        <div class="new-thread-item box">
            <label class="label block"><?php echo $temp_post_type['title'] ?></label>
            <select name="<?php echo $temp_post_type['name'] ?>">
                <option <?php if($default_value[$temp_post_type['name']] == 'publish') echo 'selected' ?> value="publish">Xuất bản</option>
                <option  <?php if($default_value['the_status'] == 'pending') echo 'selected' ?>  value="pending">Nháp</option>
            </select>
        </div>
        <?php
    }
    break;
    
    default :
    echo 'default', '<br />';
}