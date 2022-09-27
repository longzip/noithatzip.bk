<?php
	if(!defined('SECURE_CHECK')) die('Stop');
?>

<div class="option-item">                    
    <div class="option-content">
        <label for="name" class="fl">Name</label>
        <div class="field fl">
            <input type="text" required="" name="name" id="name" value="<?php return_value('name', $default_value['name'], FALSE, FALSE) ?>" />
        </div>
        
        <span class="clear"></span>
    </div>
</div>


<div class="option-item">                    
    <div class="option-content">
        <label for="title" class="fl">Slug</label>
        <div class="field fl">
            <input type="text"  name="url" id="url" value="<?php return_value('url', $default_value['url'], FALSE, FALSE) ?>" />
        </div>
        
        <span class="clear"></span>
    </div>
</div>

<div class="option-item">
    <div class="option-content">
        <label for="description" class="fl">Description</label>
        <div class="field fl">
            <textarea   name="description" id="description"><?php return_value('description', $default_value['description'], FALSE, FALSE) ?></textarea>
        </div>
        
        <span class="clear"></span>
    </div>
</div>