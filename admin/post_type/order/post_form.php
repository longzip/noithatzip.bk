<div class="new-thread-item box">
    <div class="field-title">
        <label class="label block fl"><?php echo $temp_post_type['title'] ?> <?php if($temp_post_type['require'] == '1') echo '<span class="require"> * </span>' ?></label>
    </div>
    
    <div class="field-content">
        <input  spellcheck="false" field_id="<?php echo $field['id'] ?>" autocomplete="off" <?php if($temp_post_type['require'] == '1') echo 'required' ?> name="<?php echo $temp_post_type['name'] ?>" class="none block text text-field fl input-<?php echo $field['id'] ?>" id="text-field-<?php echo $field['id'] ?>" value="<?php return_value($temp_post_type['name'], $default_value[$temp_post_type['name']], FALSE, TRUE) ?>" />
        <div class="field-order_by">
            <?php
                if(empty($default_value[$temp_post_type['name']])) $default_value[$temp_post_type['name']] = 'ORDER BY id DESC';
                $order_string = str_replace('ORDER BY ', '', $default_value[$temp_post_type['name']]);
                $order_part = explode(' ', $order_string);
                $order_by = $order_part[0];
                $order = $order_part[1];
                
                $t_fields = models_DB::get( 'SELECT * FROM ' . FIELD_TABLE . ' WHERE page_type=\'post\' ' );
                $t_remove = array('categories', 'tags');
                $t_defaults = array('time_create'=>'Ngày đăng', 'view_count'=>'Lượt xem');
                                
            ?>
            <span class="field-order-title">Sắp xếp theo</span>
            <select class="select-order_by select-order_by-<?php echo $field['id'] ?>" par="<?php echo $field['id'] ?>">
                <option value="time_update" <?php if($order_by == 'time_update') echo ' selected ' ?> >Ngày cập nhật</option>
                 
                <?php 
                    foreach($t_defaults as $k=>$t_default)
                    {
                        ?>
                        <option value="<?php echo $k ?>"  <?php if($order_by == $k) echo ' selected ' ?>><?php echo $t_default ?></option>
                        <?php
                    }
                    foreach($t_fields as $k=>$t_field)
                    {
                        $att = json_decode($t_field['attribute'], TRUE);
                         
                        if(in_array($att['name'], $t_remove)) continue;
                        if(!in_array($att['field_type'], array('text', 'number'))) continue;
                        
                        ?>
                        <option value="<?php echo $att['name'] ?>"  <?php if($order_by == $att['name']) echo ' selected ' ?>><?php echo $att['title'] ?></option>
                        <?php
                    }
                ?>
            </select>
            
            <span class="field-order-title">với thứ thự</span>
            <select class="select-order select-order-<?php echo $field['id'] ?>" par="<?php echo $field['id'] ?>">
                <option value="DESC"  <?php if($order == 'DESC') echo ' selected ' ?>>Giảm dần</option>
                <option value="ASC" <?php if($order == 'ASC') echo ' selected ' ?>>Tăng dần</option> 
            </select>
        </div>
        <span class="clear"></span>
        <div class="suggest-content">
            
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
    $(".field-order_by select").change(function(){
        var par = $(this).attr("par");
        var order_by = $("select.select-order_by-" + par).find(":selected").val();
        var order = $("select.select-order-" + par).find(":selected").val();
         
        $(".input-" + par).val("ORDER BY " + order_by + " " + order);
    })
})
</script>
<style>
.field-order-title {
    padding: 0 10px;
}
</style>

 