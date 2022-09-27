
<?php 
//echo $default_value[$temp_post_type['name']];
$khu_vuc = explode(', ', $default_value[$temp_post_type['name']] );

$count_khu_vuc = count($khu_vuc);
$tinh_thanh = $khu_vuc[$count_khu_vuc - 1];

 

if(!empty($khu_vuc[$count_khu_vuc - 2])) $quan_huyen  = $khu_vuc[$count_khu_vuc - 2];
else $quan_huyen = '';

if(!empty($khu_vuc[$count_khu_vuc - 3])) $phuong_xa  = $khu_vuc[$count_khu_vuc - 3];
else $phuong_xa = '';

?>
<script>
    $(document).ready(function(){
        <?php
        if(!empty($tinh_thanh))
        {
            ?>
            setTimeout(function(){
                $(".khu_vuc-<?php echo $temp_post_type['name'] ?> .tinh_thanh-select").val("<?php echo $tinh_thanh ?>").change();
           }, 3000); 
            <?php
        }
        ?>
       
       <?php
        if(!empty($quan_huyen))
        {
            ?>
       setTimeout(function(){
            $(".khu_vuc-<?php echo $temp_post_type['name'] ?> .quan_huyen-select").val("<?php echo $quan_huyen ?>").change();
       }, 4000); 
       <?php
        }
        
         
        if(!empty($phuong_xa))
        {
        ?>
       setTimeout(function(){
            $(".khu_vuc-<?php echo $temp_post_type['name'] ?> .phuong_xa-select").val("<?php echo $phuong_xa ?>").change();
       }, 5000); 
       <?php
        }
        ?>
    });
</script>
<div class="new-thread-item box khu_vuc khu_vuc-<?php echo $temp_post_type['name'] ?>" >
    <div class="field-title none">
        <label class="label block fl"><?php echo $temp_post_type['title'] ?> <?php if($temp_post_type['require'] == '1') echo '<span class="require"> * </span>' ?></label>
    </div>
    
    <div class="field-content">
        <div class="field-item field-item-tinh_thanh clearfix">
            <div class="field-title">
                <label class="label block">Tỉnh thành</label>
            </div>
            <div class="field-content">
                <select   class="tinh_thanh-select" par="<?php echo $temp_post_type['name'] ?>"   >
                    <option <?php if($default_value[$temp_post_type['name']] == '') echo 'selected ' ?> value="">-- Tỉnh Thành --</option>
                    <?php
                        $lists = models_DB::get('SELECT * FROM ' . KHU_VUC_TABLE . ' WHERE parent = 0 ORDER BY title ASC ');
                         
                        $n_lists = array('Hà Nội', 'Hồ Chí Minh', 'Đà Nẵng', 'Hải Phòng');
                        foreach($lists as $list)
                        {
                            if(!in_array($list, $n_lists)) $n_lists[] = $list['title'];
                        }
                         
                        foreach( $n_lists as $list)
                        {
                            ?>
                            <option class="<?php echo $temp_post_type['name'] ?>-<?php echo pretty_string($list) ?>" <?php if($tinh_thanh == $list) echo 'selected ' ?> value="<?php echo $list ?>"><?php echo $list ?></option>
                            <?php
                        }
                    ?>
                </select>
            </div>
            <span class="clear"></span>
        </div>
        
        <div class="field-item field-item-quan_huyen clearfix">
            <div class="field-title">
                <label class="label block  ">Quận/Huyện</label>
            </div>
            <div class="field-content">
                <select   class="quan_huyen-select"  par="<?php echo $temp_post_type['name'] ?>"  >
                    <option <?php if($default_value[$temp_post_type['name']] == '') echo 'selected ' ?> value="">-- Quận/Huyện --</option>
                </select>
            </div>
            <span class="clear"></span>
        </div>
        
        <div class="field-item field-item-phuong_xa clearfix">
            <div class="field-title ">
                <label class="label block  ">Phường xã</label>
            </div>
            <div class="field-content">
                <select   class="phuong_xa-select"  par="<?php echo $temp_post_type['name'] ?>"  >
                    <option <?php if($default_value[$temp_post_type['name']] == '') echo 'selected ' ?> value="">-- Phường xã --</option>
                </select>
            </div>
            <span class="clear"></span>
        </div>
    
        <input spellcheck="false"   autocomplete="off" <?php if($temp_post_type['require'] == '1') echo 'required' ?> name="<?php echo $temp_post_type['name'] ?>" class="block text text-field fl khu_vuc_input"   value="<?php return_value($temp_post_type['name'], $default_value[$temp_post_type['name']], FALSE, TRUE) ?>" />
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