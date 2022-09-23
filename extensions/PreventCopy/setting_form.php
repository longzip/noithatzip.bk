<div class="wrap-add none"  ><span class="add"><i title="Thêm" class="fa fa-plus"></i></span></div>
<div class="post-form-item clearfix" id="list-post-item" > 
            <?php 
                $extension_info = models_DB::get('SELECT * FROM ' . EXTENSION_TABLE . ' WHERE name=\'PreventCopy\'' );
               
                if(empty($extension_info)) $list_option = array();

                $list_option = json_decode($extension_info[0]['attributes'], TRUE);
                 
                
            ?>
            <div class="new-thread-item box">
                <div class="field-item clearfix none">
                    <div class="field-title">
                        <label class="label block">Vị trí hiển thị</label>
                    </div>
                         
                    <div class="field-content">
                        <select name="display_position">
                            <option value="before_close_body">Trước khi đóng thẻ body</option>
                        </select>
                    </div>
                </div>
            
            
                  <div class="field-item clearfix">
                    <div class="field-title">
                        <label class="label block">Tích vào những tùy chọn bạn muốn</label>
                    </div>
                    
                    <div >
                         <label class="block1">
                            <input <?php if(in_array('right-click-body', $list_option)) echo ' checked ' ?> name="list_option[]" value="right-click-body" type="checkbox" /> Chống click chuột phải
                         </label>
                         
                          
                          <label  class="block1">
                            <input <?php if(in_array('save-image', $list_option)) echo ' checked ' ?> name="list_option[]" value="save-image" type="checkbox" /> Chống lưu hình ảnh
                         </label>
                         
                         <label  class="block1">
                            <input <?php if(in_array('coppy', $list_option)) echo ' checked ' ?> name="list_option[]" value="coppy" type="checkbox" /> Chống Coppy nội dung
                         </label>
                    </div>
                    
                     
                </div>
                
            </div> 
</div>