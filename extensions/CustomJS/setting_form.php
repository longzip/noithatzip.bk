<?php 
    $empty_row = array(
                'name'  => $extension_name,
                'attributes' => json_encode(array('content'=>'')),
                'display_position'  => '',
                'is_actived'        => '0'
            );
?>
<div class="wrap-add"  ><span class="add"><i title="Thêm" class="fa fa-plus"></i></span></div>
<div class="post-form-item clearfix" id="list-post-item" >
    
    <?php 
        $list_rows = get_extension($_GET['extension']);
        if(empty($list_rows)) $list_rows[0] = $empty_row;
        foreach($list_rows as $k=>$list_row)
        {
            $extension_info = get_extension_by_id($list_row['id']); // Info của 1 hàng
            $attributes = json_decode($extension_info['attributes'], TRUE);
            ?>
            <div class="new-thread-item box">
                <span title="Xóa" class="delete-position"><i class="fa fa-close"></i></span>
                <div class="field-item clearfix">
                    <div class="field-title">
                        <label class="label block">Vị trí hiển thị</label>
                    </div>
                         
                    <div class="field-content">
                        <select name="display_position[]">
                            <option <?php if($extension_info['display_position'] == 'after_open_head') echo 'selected' ?> value="after_open_head">Sau thẻ mở head &nbsp; &nbsp; ( &lt;head&gt; )</option>
                            <option <?php if($extension_info['display_position'] == 'before_close_head') echo 'selected' ?> value="before_close_head">Trước thẻ đóng head &nbsp; &nbsp; ( &lt;/head&gt; )</option>
                            <option <?php if($extension_info['display_position'] == 'after_open_body') echo 'selected' ?> value="after_open_body">Sau thẻ mở body &nbsp; &nbsp; ( &lt;body&gt; )</option>
                            <option  <?php if($extension_info['display_position'] == 'before_close_body') echo 'selected' ?> value="before_close_body">Trước thẻ đóng body &nbsp; &nbsp; ( &lt;/body&gt; )</option>
                             
                        </select>
                    </div>
                </div>
            
                <div class="field-item clearfix">
                    <div class="field-title">
                        <label class="label block">Nội dung</label>
                    </div>
                
                    <div class="field-content">
                        <textarea spellcheck="false" style="box-sizing: border-box;width:100%;height:150px" class="text" name="content[]"><?php echo $attributes['content'] ?></textarea>
                    </div>
                </div>
                
            </div>
            <?php
        }
    ?>
    
</div>