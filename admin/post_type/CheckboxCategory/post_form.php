<script>
    $(document).ready(function(){
        $(".category-search").keyup(function(){
            var particular = $(this).attr("particular");
            
            var str = '';
            
            if($(".category-search").val() != '')
            {
                $("#field-" + particular).find(".forum-label").each(function()
                {
                    $(this).css("display", "none");
                    
                    str = $(this).text().toLowerCase();
                    
                     
                    
                    if(str.search($(".category-search").val().toLowerCase()) >= 0) $(this).css("display", "block");
                })
            }
            else
            {
                $(".forum-label").css("display", "block");
            }
            
        })
    })
</script>
<?php 
    $field_id = $field['id'];
?>
<div class="new-thread-item box CheckboxCategory" id="field-<?php echo $field['id'] ?>">
    <div class="field-title">
        <label style="width: 300px;" class="label block fl"><?php echo $temp_post_type['title'] ?> <?php if($temp_post_type['require'] == '1') echo '<span class="require"> * </span>' ?></label>
        <input placeholder="Tìm kiếm"  class="block fr text category-search" type="text" particular="<?php echo $field['id'] ?>" />
        <span class="clear"></span>
    </div>
    
    <div class="field-content">
		<?php
			$sub_count = 0;
				
            if(!function_exists('display_forum_checkbox'))
            {
                function display_forum_checkbox($forum, $selected = array())
    			{
    				global $temp_post_type;
    				global $field_id;
    				global $sub_count;
    				?>
    					<div class="forum">
    						<div class="forum-detail">
    							<label for="categories-<?php echo $field_id ?>-<?php echo $forum['id'] ?>" class="forum-label checkbox-beautiful <?php if(in_array($forum['id'], $selected)) echo ' checked ';else echo ' uncheck ' ?>"><?php echo $forum['title'] ?></label>
                                <input id="categories-<?php echo $field_id ?>-<?php echo $forum['id'] ?>" class="none" name="<?php echo $temp_post_type['name'] ?>[]" type="checkbox" <?php if(in_array($forum['id'], $selected)) echo ' checked'; ?>  value="<?php echo $forum['id'] ?>" />
    							
    							
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
    						else $sub_count=0;
    					   ?>
    					   </div>
    				
    				<?php
    			}
            }
			
			$forums = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=0 ORDER BY title ASC' );
			$sub_count = 0;
			foreach($forums as $forum)
			{
				
				?>
				<div class="forum-item">
					<?php display_forum_checkbox($forum, explode(',', $default_value[$temp_post_type['name']])) ?>
				</div>
				<?php
			}
		?>
		
		<span class="clear"></span>
    </div>
    <?php
    if(!empty($temp_post_type['description']))
    {
        ?>
        <div class="form-description">
            <span class="arrow"></span>

            <?php echo $temp_post_type['description'] ?>
        </div>
        <?php
    }
    ?>
     
</div>
<span class="clear"></span>


 