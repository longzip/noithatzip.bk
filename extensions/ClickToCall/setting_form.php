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
            
            
                 
            </div> 
</div>