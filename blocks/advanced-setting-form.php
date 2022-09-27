<script type="text/javascript" src="<?php echo CDN_DOMAIN ?>/apps/jscolor-2.0.4/jscolor.js"></script>
<?php 
    if(empty($default['block_border_color'])) $default['block_border_color'] = '';
    if(empty($default['block_border_style'])) $default['block_border_style'] = '';
    if(empty($default['block_border_width'])) $default['block_border_width'] = '0px';
    
?>
<fieldset>
    <legend>Cài đặt Viền:</legend>
    <div class="advanced-content clearfix">
        <div class="form-group fl clearfix v-col-lg-4 v-col-md-4 border-box">
            <div class="form-group-inner clearfix">
                <label class="" for="name">Màu viền</label>     
                <input class="jscolor form-control parameter text" parameter="block_border_color" type="text" value="<?php echo $default['block_border_color'] ?>" />
            </div>
        </div>
        
        <div class="form-group fl clearfix v-col-lg-4 v-col-md-4 border-box">
            <div class="form-group-inner clearfix">
                <label class="" for="name">Kiểu viền viền</label>     
                <select class="parameter" parameter="block_border_style" >
                    <option value="none">-- None --</option>
                    <option <?php if($default['block_border_style'] == 'dotted') echo 'selected' ?> value="dotted">Dấu chấm</option>
                    <option <?php if($default['block_border_style'] == 'dashed') echo 'selected' ?> value="dashed">Nét đứt</option>
                    <option <?php if($default['block_border_style'] == 'solid') echo 'selected' ?> value="solid">Viền liền</option>
                    <option <?php if($default['block_border_style'] == 'double') echo 'selected' ?> value="double">Viền đôi</option>
                </select>
            </div>
        </div>
        
        <div class="form-group fl clearfix v-col-lg-4 v-col-md-4 border-box">
            <div class="form-group-inner clearfix">
                <label class="" for="name">Kích thước viền</label>     
                <select class="parameter" parameter="block_border_width" >
                    <?php 
                        for($i=0;$i<=10;$i++)
                        {
                            ?>
                            <option <?php if($default['block_border_width'] == $i . 'px') echo 'selected' ?> value="<?php echo $i ?>px"><?php echo $i ?>px</option>        
                            <?php
                        }
                    ?>
                </select>
            </div>
        </div>
    </div>
</fieldset>


<fieldset>
    <legend>Cài đặt Nền:</legend>
    <div class="advanced-content clearfix">
        <div class="form-group fl clearfix v-col-lg-4 v-col-md-4 border-box">
            <div class="form-group-inner clearfix">
                <label class="" for="name">Màu nền</label>     
                <input class="jscolor form-control parameter text" parameter="block_background_color" type="text" value="<?php echo $default['block_background_color'] ?>" />
            </div>
        </div>
        <div class="form-group fl clearfix v-col-lg-4 v-col-md-4 border-box">
            <div class="form-group-inner clearfix">
                <label class="" for="name" style="width: 20%;">Ảnh nền</label> 
                <input type="text" placeholder="Đường dẫn ảnh" class="parameter fl" id="block_background_image" parameter="block_background_image"  value="<?php echo $default['src'] ?>" />
        		
        		<input style="margin: 4px 10px;" type="button" value="Chọn ảnh" class="fl show-media-frame btn btn-info" particular="block_background_image" /><br /><br />
        		<span class="clear"></span>
                <div class="none" id="block_background_image_display" style="max-width: 90%;margin:auto" >
                    <img style="max-width: 90%;display:block;margin:auto" src="<?php echo $default['src'] ?>" />
                </div>
            </div>
        </div>
        
    </div>
</fieldset>


 


