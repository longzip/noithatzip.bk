<div class="option-item">
                    
    <div class="option-content">
        <label for="title" class="fl">Title</label>
        <div class="field fl">
            <input type="text" required="" name="title" id="title" value="<?php return_value('title', $default_value['title'], FALSE, FALSE) ?>" />
        </div>
        
        <span class="clear"></span>
    </div>
</div>
 
<div class="option-item">
    <div class="option-content">
        <label for="url" class="fl">Url</label>
        <div class="field fl">
            <input type="text" name="url" id="url" value="<?php return_value('url', $default_value['url'], FALSE, FALSE) ?>" />
        </div>
        
        <span class="clear"></span>
    </div>
</div>

<div class="option-item">   
    <div class="option-content">
        <label for="parent" class="fl">Parent</label>
        <div class="field fl">
        <?php
            $sub_count = 0;
            function display_select_tag($forum)
            {
                global $sub_count;
                global $default_value;
                ?>
                <option value="<?php echo $forum['id'] ?>" <?php check_select('parent', $default_value['parent'], $forum['id']) ?>><?php for($i=0;$i<$sub_count;$i++) echo '----'; echo $forum['title'] ?></option>
                      <?php 
                        
                        $sub_forums = models_DB::get('SELECT * FROM ' . TAG_TABLE . ' WHERE parent=' . $forum['id'] . ' ORDER BY stt ASC');
                        if(!empty($sub_forums))
                        {
                            $sub_count++;
                            foreach($sub_forums as $s_k=>$s_v)
                            {
                                display_select_tag($s_v);
                                if($s_k == (count($sub_forums) - 1)) $sub_count--;
                            }
                            ?>
                            
                            <?php
                        }
                        //else 
                        
                       ?>
                       
                       <?php 
                    ?>
                
                <?php
            }
            ?>
            <select  name="parent" id="parent">
            <option value="0" <?php check_select('parent', $default_value['parent'], '0') ?>>None</option>
                   
            <?php 
                $forums = models_DB::get('SELECT * FROM ' . TAG_TABLE . ' WHERE parent=0 ORDER BY stt ASC');
                
                foreach($forums as $forum)
                {
                    display_select_tag($forum); 
                }
            ?>
                
                
            </select>
        </div>
        
        <span class="clear"></span>
    </div>
</div>
 

<div class="option-item">
    <div class="option-content">
        <label for="description" class="fl">Description</label>
        <div class="field fl">
            <textarea class="main-content" name="description" id="description"><?php return_value('description', $default_value['description'], FALSE, FALSE) ?></textarea>
        </div>
        
        <span class="clear"></span>
    </div>
</div>


 <div class="option-item">
    <div class="option-content">
        <label for="image" class="fl">Image</label>
        <div class="field fl">
            <div class="form-box image" id="form-image">
                <div class="form-field">
                    <input style="width: 70%;" class="form-control" id="image"  value="<?php return_value('image', $default_value['image'], FALSE, FALSE) ?>" type="text" name="image" />&nbsp;&nbsp;
                    <input type="button" value="Select" class="show-media-frame btn btn-info" particular="image" /><br /><br />
                    
                </div>
                <img id="image_display" style="max-width: 100%;" src="<?php return_value('image', $default_value['image'], FALSE, FALSE) ?>" />
            
              
            </div>
            
        </div>
        
        <span class="clear"></span>
    </div>
</div>


<div class="option-item">
    
    <div class="option-content">
        <label for="seo_title" class="fl">Seo title</label>
        <div class="field fl">
            <textarea name="seo_title" id="seo_title"><?php return_value('seo_title', $default_value['seo_title'], FALSE, FALSE) ?></textarea>
        </div>
        
        <span class="clear"></span>
    </div>
</div>

<div class="option-item">
    <div class="option-content">
        <label for="seo_description" class="fl">Seo description</label>
        <div class="field fl">
            <textarea name="seo_description" id="seo_description"><?php return_value('seo_description', $default_value['seo_description'], FALSE, FALSE) ?></textarea>
        </div>
        
        <span class="clear"></span>
    </div>
</div>
 