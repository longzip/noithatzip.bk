<div class="wrap-add none"  ><span class="add"><i title="Thêm" class="fa fa-plus"></i></span></div>
<div class="post-form-item clearfix" id="list-post-item" > 
            <?php 
                $extension_info = models_DB::get('SELECT * FROM ' . EXTENSION_TABLE . ' WHERE name=\'' . $extension_name . '\'' );
               
                if(empty($extension_info)) $list_option = array();

                $list_option = json_decode($extension_info[0]['attributes'], TRUE);
                
                
                
                if(empty($list_option['style'])) $list_option['style'] = 'picEyes'; 
                
            ?>
            <div class="new-thread-item box">
             <div class="field-item clearfix  ">
                    <div class="field-title">
                        <label class="label block">Chọn hiệu ứng</label>
                    </div>
                         
                    <div class="field-content">
                            <?php 
                                $scans = scandir(dirname(__FILE__) . '/Plugins');
                                unset($scans[0], $scans[1]);
                            ?>
                        <select name="list_option[style]">                            
                            
                            <?php 
                                foreach($scans as $scan)
                                {
                                    ?>
                                    <option <?php if($scan == $list_option['style']) echo 'selected ' ?> value="<?php echo $scan ?>"><?php echo $scan ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="new-thread-item box">
                <div class="field-item clearfix none">
                    <div class="field-title">
                        <label class="label block">Chọn danh sách ảnh được phóng to khi click</label>
                    </div>
                         
                    <div class="field-content">
                        <select name="display_position">
                            <option value="before_close_body">Trước khi đóng thẻ body</option>
                        </select>
                    </div>
                </div>
                
                
            
                  <div class="field-item clearfix">
                    <div class="field-title">
                        <label class="label block">Chọn danh sách ảnh được phóng to khi click</label>
                    </div>
                    
                    <div >
                         <label class="block1">
                            <input <?php if(in_array('body', $list_option)) echo ' checked ' ?> name="list_option[]" value="body" type="checkbox" /> Tất cả các ảnh
                         </label>
                         
                          
                          <label  class="block1">
                            <input <?php if(in_array('#post-content', $list_option)) echo ' checked ' ?> name="list_option[]" value="#post-content" type="checkbox" /> Ảnh trong nội dung bài viết
                         </label>
                         
                         <label  class="block1">
                            <input <?php if(in_array('custom', $list_option)) echo ' checked ' ?> name="list_option[]" value="custom" type="checkbox" /> Tùy chọn khác
                            <input name="list_option[custom-selector]" value="<?php echo $list_option['custom-selector'] ?>" type="text" class="text" placeholder="VD : div, span, #example" />
                         </label>
                    </div>
                    
                     
                </div>
                
            </div> 
            
</div>