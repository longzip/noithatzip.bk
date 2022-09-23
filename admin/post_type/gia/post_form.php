<div class="new-thread-item box">
    <div class="field-title">
        <label class="label"><?php echo $temp_post_type['title'] ?> <?php if($temp_post_type['require'] == '1') echo '<span class="require"> * </span>' ?></label>
    </div>
    
    <div class="field-content">
        <input spellcheck="false" type="text" autocomplete="off" <?php if($temp_post_type['require'] == '1') echo 'required' ?> name="<?php echo $temp_post_type['name'] ?>" class="block gia text-field fl" value="<?php return_value($temp_post_type['name'], $default_value[$temp_post_type['name']], FALSE, TRUE) ?>" />
        <span class="clear"></span>
        <div class="suggest-content">
            <ul>
            <?php 
                $lists = array();// models_DB::get('SELECT DISTINCT ' . $temp_post_type['name'] . ' FROM ' . POST_TABLE . ' WHERE ' . $temp_post_type['name'] . ' != \'\' limit 9999 ');
                foreach($lists as $list)
                {
                    ?>
                    <li><?php echo $list[$temp_post_type['name']] ?></li>
                    <?php
                }
            ?>
            </ul>
        </div>
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

<script>
$("document").ready(function(){
    
})
</script>


 