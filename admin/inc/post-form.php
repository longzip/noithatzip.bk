<script>
    $(document).ready(function(){
        change_title_count();
    
        function change_title_count()
        {
            var remain_len = 70 - $("#seo-title").val().length ;
            $(".seo-title-count").text(remain_len);
            if(remain_len < 0) $(".seo-title-count").removeClass("yes"); else $(".seo-title-count").addClass("yes") 
        }
        
        $("#seo-title").keyup(function(){
            change_title_count();
        })
        
        change_des_count();
        
        function change_des_count()
        {
            var remain_len = 156 - $("#seo-description").val().length ;
            $(".seo-description-count").text(remain_len);
            if(remain_len < 0) $(".seo-description-count").removeClass("yes"); else $(".seo-description-count").addClass("yes") 
        }
        
        $("#seo-description").keyup(function(){
            change_des_count();
        });
        
        $(".new-thread-item.time_update").append('<span class="toggle-schedule"><i class="fa fa-clock-o"></i> Hẹn lịch</span>');
        $(".new-thread-item.time_update").append('<div class="schedule"></div>');
        $(".new-thread-item.time_update .schedule").append($(".new-thread-item.start_time"));
        $(".new-thread-item.time_update .schedule").append($(".new-thread-item.end_time"));
        
        $("body").on("click", ".toggle-schedule", function(e){
            $(".schedule").slideToggle();
        });
    })
</script>
        <div id="field-group" class="fixed-on-scroll" style="z-index: 2;">
            <span class="active default" particular="default">Tổng quan</span>
            <span class="seo" particular="seo">SEO</span>
            <span class="other" particular="other">Khác</span>
         </div>
         
         <div id="new-post-col-1" class="fl border-box v-col-lg-9 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-6">
            <div id="new-post-col-1-inner">
                <div id="default" class="field-group">
                        
                        <?php
                        
                        global $g_page_info;
                        
                        $arr_fixed_field = array('the_status', 'template', 'time_update', 'start_time', 'end_time');
                        
                        $t = 'SELECT * FROM ' . FIELD_TABLE . ' WHERE  ( page_type=\''. $page_type .'\' OR page_type=\'all\' ) AND ( tab_display=\'general\' ) AND ( post_type=0 OR post_type=\'' . $post_type_id .'\' ) ORDER BY stt ASC ';
                         
                        $fields = models_DB::get($t);
                        $fixed_fields = array();
                          
                        foreach($fields as $field)
                        {
                            $temp_post_type = json_decode($field['attribute'], TRUE);
                            if(in_array( $temp_post_type['name'] , $arr_fixed_field)) 
                            {
                                $fixed_fields[] = $field;
                                continue;
                            }
                            
                             
                            if(in_array($g_page_info['page_type'], array('new-post', 'new-category', 'new-tag')) && (!isset($_POST['submit'])))  $default_value[$temp_post_type['name']] = $temp_post_type['default'];
                            ?>
                            <div class="post-form-item" id="post-form-item-<?php echo $field['id'] ?>">
                            <?php
                            include PATH_ROOT . '/admin/post_type/' . $temp_post_type['field_type'] . '/post_form.php';
                            ?>
                            </div>
                            <?php
                             
                        }
                        ?>
                    </div>
                    
                    <div id="seo" class="field-group">
                        
                        <?php
                        
                         
                         $fields = models_DB::get('SELECT * FROM ' . FIELD_TABLE . ' WHERE ( page_type=\''. $page_type .'\' OR page_type=\'all\' ) AND tab_display=\'seo\' AND ( post_type=\'' . $post_type_id . '\' OR post_type=0 ) ORDER BY stt ASC ');
                         //echo 'SELECT * FROM ' . FIELD_TABLE . ' WHERE ( page_type=\''. $page_type .'\' OR page_type=\'all\' ) AND tab_display=\'seo\' ORDER BY stt ASC ';
                         
                        //h($fields);
                        
                        foreach($fields as $field)
                        {
                            $temp_post_type = json_decode($field['attribute'], TRUE);
                             
                            if(in_array($g_page_info['page_type'], array('new-post', 'new-category', 'new-tag'))  && (!isset($_POST['submit'])) ) $default_value[$temp_post_type['name']] = $temp_post_type['default'];
                            ?>
                            <div class="post-form-item" id="post-form-item-<?php echo $field['id'] ?>">
                            <?php
                            include PATH_ROOT . '/admin/post_type/' . $temp_post_type['field_type'] . '/post_form.php';
                            ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    
                    <div id="other" class="field-group">
                        
                        <?php
                        
                        $fields = models_DB::get('SELECT * FROM ' . FIELD_TABLE . ' WHERE ( page_type=\''. $page_type .'\' OR page_type=\'all\' ) AND tab_display=\'other\' AND ( post_type=\'' . $post_type_id . '\' OR post_type=0 ) ORDER BY stt ASC ');
                        
                        //h($fields);
                        
                        foreach($fields as $field)
                        {
                            $temp_post_type = json_decode($field['attribute'], TRUE);
                            
                            
                             
                            
                            if(in_array($g_page_info['page_type'], array('new-post', 'new-category', 'new-tag'))  && (!isset($_POST['submit'])) ) 
                            {
                                 $default_value[$temp_post_type['name']] = $temp_post_type['default'];
                                   
                            }
                             ?>
                            <div class="post-form-item" id="post-form-item-<?php echo $field['id'] ?>">
                            <?php
                            
                            //echo '-', $default_value[$temp_post_type['name']], '-';
                            
                            include PATH_ROOT . '/admin/post_type/' . $temp_post_type['field_type'] . '/post_form.php';
                            ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
            
            </div>
         </div>
         <div id="new-post-col-2" class=" fr border-box v-col-lg-3 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-6">
            <div id="new-post-col-2-inner" class="fixed-on-scroll">
            <?php 
                foreach($fixed_fields as $field)
                {
                    $temp_post_type = json_decode($field['attribute'], TRUE);
                     
                    
                     
                    if(in_array($g_page_info['page_type'], array('new-post', 'new-category', 'new-tag')) && (!isset($_POST['submit'])))  $default_value[$temp_post_type['name']] = $temp_post_type['default'];
                    ?>
                    <div class="post-form-item" id="post-form-item-<?php echo $field['id'] ?>">
                    <?php
                    include PATH_ROOT . '/admin/post_type/' . $temp_post_type['field_type'] . '/post_form.php';
                    ?>
                    </div>
                    
                    
                    <?php
                     
                }
                ?>
                <div id="save" class="box"><input type="submit" value="Lưu lại" name="submit" class="btn btn-success" /></div>
            </div>
         </div>
          