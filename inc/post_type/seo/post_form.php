 <?php
    $default_value[$temp_post_type['name']] = json_decode($default_value[$temp_post_type['name']], TRUE);     
     
 ?>
 
<div class="new-thread-item box relative">
    

    <label class="label block fl">SEO Title</label>
    <input placeholder="<?php echo $default_value['title'] ?>" id="seo-title" name="<?php echo $temp_post_type['name'] ?>[title]" class="block text fl" value="<?php return_value($temp_post_type['name'], $default_value[$temp_post_type['name']]['title'], FALSE, TRUE, 'title') ?>" />
    <span class="absolute word-count seo-title-count yes">70</span>
    <span class="clear"></span>
</div>
<span class="clear"></span>


 
<div class="new-thread-item box relative">
    <label class="label block fl">SEO Description</label>
    <textarea style="width: 100%;" id="seo-description" name="<?php echo $temp_post_type['name'] ?>[description]" class="block text fl" ><?php return_value($temp_post_type['name'], $default_value[$temp_post_type['name']]['description'], FALSE, TRUE, 'description') ?></textarea>
     
     <span class="absolute word-count seo-description-count yes">156</span>
    <span class="clear"></span>
</div>
<span class="clear"></span>


<div class="new-thread-item box">
    <label class="label block fl">SEO Keywords</label>
    <textarea style="width: 100%;" id="seo-keywords" name="<?php echo $temp_post_type['name'] ?>[keywords]" class="block text fl" ><?php return_value($temp_post_type['name'], $default_value[$temp_post_type['name']]['keywords'], FALSE, TRUE, 'keywords') ?></textarea>
     
    <span class="clear"></span>
</div>
<span class="clear"></span>


<div class="new-thread-item box">
    <label class="label block fl">Index</label>
    
    <input class="none" id="radio-<?php echo $field['id'] ?>-index" <?php if($default_value[$temp_post_type['name']]['index'] == 'index') echo 'checked'; ?>     value="index" type="radio"  name="<?php echo $temp_post_type['name'] ?>[index]" />
    <label name_particular="<?php echo $temp_post_type['name'] ?>[index]" class="radio-beautiful  <?php if($default_value[$temp_post_type['name']]['index'] == 'index') echo 'radiochecked ';else echo ' radiouncheck' ?>" for="radio-<?php echo $field['id'] ?>-index" >Index</label>
                
    <br />
    
    <input class="none" id="radio-<?php echo $field['id'] ?>-noindex" <?php if($default_value[$temp_post_type['name']]['index'] == 'noindex') echo 'checked'; ?>     value="noindex" type="radio"  name="<?php echo $temp_post_type['name'] ?>[index]" />
    <label name_particular="<?php echo $temp_post_type['name'] ?>[index]" class="radio-beautiful <?php if($default_value[$temp_post_type['name']]['index'] == 'noindex') echo 'radiochecked ';else echo ' radiouncheck' ?>" for="radio-<?php echo $field['id'] ?>-noindex" >Noindex</label>
                
    
</div>
<span class="clear"></span>

<div class="new-thread-item box">
    <label class="label block fl">Follow</label>
    
    <input class="none" id="radio-<?php echo $field['id'] ?>-follow" <?php if($default_value[$temp_post_type['name']]['follow'] == 'follow') echo 'checked'; ?>     value="follow" type="radio"  name="<?php echo $temp_post_type['name'] ?>[follow]" />
    <label name_particular="<?php echo $temp_post_type['name'] ?>[follow]" class="radio-beautiful  <?php if($default_value[$temp_post_type['name']]['follow'] == 'follow') echo 'radiochecked ';else echo ' radiouncheck' ?>" for="radio-<?php echo $field['id'] ?>-follow" >Follow</label>
                
    <br />
    
    <input class="none" id="radio-<?php echo $field['id'] ?>-nofollow" <?php if($default_value[$temp_post_type['name']]['follow'] == 'nofollow') echo 'checked'; ?>     value="nofollow" type="radio"  name="<?php echo $temp_post_type['name'] ?>[follow]" />
    <label name_particular="<?php echo $temp_post_type['name'] ?>[follow]" class="radio-beautiful <?php if($default_value[$temp_post_type['name']]['follow'] == 'nofollow') echo 'radiochecked ';else echo ' radiouncheck' ?>" for="radio-<?php echo $field['id'] ?>-nofollow" >Nofollow</label>
                
    
     
    
    <span class="clear"></span>
</div>
<span class="clear"></span>

<div class="new-thread-item box">
    

    <label class="label block fl">Canonical</label>
    <input name="<?php echo $temp_post_type['name'] ?>[canonical]" class="block text fl" value="<?php return_value($temp_post_type['name'], $default_value[$temp_post_type['name']]['canonical'], FALSE, TRUE, 'canonical') ?>" />
    <span class="clear"></span>
</div>
<span class="clear"></span>


<div class="new-thread-item box">
    

    <label class="label block fl">301 Redirect</label>
    <input name="<?php echo $temp_post_type['name'] ?>[301]" class="block text fl" value="<?php return_value($temp_post_type['name'], $default_value[$temp_post_type['name']]['301'], FALSE, TRUE, '301') ?>" />
    <span class="clear"></span>
</div>
<span class="clear"></span>
 