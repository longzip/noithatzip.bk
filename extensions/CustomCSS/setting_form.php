<?php 
    $empty_row = array(
                'name'  => $extension_name,
                'attributes' => json_encode(array('content'=>'')),
                'display_position'  => '',
                'is_actived'        => '0'
            );

//Update CSS version

?>


<div class="wrap-add none"  ><span class="add"><i title="Thêm" class="fa fa-plus"></i></span></div>
<div class="post-form-item clearfix" id="list-post-item" >
    
    <?php 
        $list_rows = get_extension($_GET['extension']);
        if(empty($list_rows)){
            $new_extension = array('name'=>'CustomCSS', 'attributes'=>'{"content":""}', 'display_position'=> 'before_close_body' , 'is_actived'=>0); 
            models_DB::insert($new_extension, EXTENSION_TABLE); 
        } 
        
        
         
        
        
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
                        <label class="label block">Nội dung CSS</label>
                    </div>
                
                    <div class="field-content">
                        <textarea  spellcheck="false" style="box-sizing: border-box;width:100%;height:150px" class="<?php if(empty($attributes['content'])) echo 'none' ?>  text" name="content[]"><?php echo $attributes['content'] ?></textarea>
                    </div>
                </div>
                
            </div>
            <?php
            $val = $attributes['content'];
        }
    ?>
    <div id="editor"></div>
    <textarea id="editor-textarea" class="none" name="editor-textarea"></textarea>
</div>
<br /><br />
<script src="<?php echo CDN_DOMAIN ?>/apps/ace-builds-master/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>



<script>
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.getSession().setMode("ace/mode/css"); 
    
    setInterval(function(){
       $("#editor-textarea").val(editor.getValue()); 
    }, 200);
    
    $("document").ready(function(){
        var ajax_href = site_url + '/admin/?page_type=handle-ajax-editor';
        var dir = "<?php echo urlencode(CLIENT_ROOT . '/custom/css/custom.css')  ?>";
        $.ajax({
            url:ajax_href,
            type:"post",
            data:{type:"get_file_content",dir:dir},
            success:function(data){ 
                 
                editor.setValue(data);                
            }
        });
        
        document.onkeydown=function(e){
            if(e.keyCode == 17) isCtrl=true;
            if(e.keyCode == 83 && isCtrl == true) {
                $(".btn.btn-success").click();
                return false;
            }
        }
    });
    
    
    
</script>
<style>
div#editor {
    width: 100%;
    position: relative;
    height: 400px;
}
</style>