<script>
$("document").ready(function(){
    
    $('.v-form input[name="type"]').remove();
    $('.v-form input').attr("required", false);
    
    $("#new-post-col-1-inner input, #new-post-col-1-inner select").change(function(){
        var count_hotline_style = $(".display_style-radio").size();
        
        var current_style = 1;
        
        function change_css(){ 
            $("#current_style").val(current_style); 
            $.ajax({
                url:site_url + '/admin/?page_type=handle-ajax',
                type:"post",
                data:$("#main-content form").serialize(),
                success:function(data){
                      //$(".css-style").html("");
                      $(".css-style-" + current_style).html(data);
                      
                      
                      
                      if(current_style == count_hotline_style) return;
                      else
                      {
                            current_style ++;
                            change_css();
                      }
                    }
            });
        }
        change_css();
     });
     
     $(".form_position").change(function(){
        var type = $(this).find(":selected").attr("type");
         
        $(".list-instance-item").css("display", "none");
        $(" " + type + " ").css("display", "block");
     });
     
     $(".form_position").change();
     
     $(".display_style-radio").click(function(){
            var par  = $(this).val();
             
            $(".display").addClass("none");
            $(".display-" + par).removeClass("none");
     });
     
});
</script>
<div class="wrap-add none"  ><span class="add"><i title="Thêm" class="fa fa-plus"></i></span></div>
<div class="post-form-item clearfix" id="list-post-item" > 
            
            <?php
                $popup_info = models_DB::get('SELECT * FROM ' . EXTENSION_TABLE . ' WHERE name=\'PopupForm\' AND display_position=\'before_close_body\'' );
                $popup_info = $popup_info[0];        
                $attr = json_decode($popup_info['attributes'], TRUE);             
            ?>
            <input type="hidden" name="fixed_form_type" value="change_extension_fixedform_setting" />
            <input id="current_style" name="current_style" type="hidden" value="<?php echo $default_value['display_style'] ?>" />
            
            <div class="new-thread-item box">
                <div class="field-item clearfix">
                        <div class="field-title">
                            <label class="label block">Thời gian bắt đầu hiện popup</label>
                        </div>
                        
                        <div class="time-for">
                            <select name="time_delay_minute">
                            <?php 
                                for($i=0;$i<=59;$i++)
                                {
                                    ?>
                                    <option <?php if($attr['time_delay_minute'] == $i) echo 'selected' ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php
                                }
                            ?>
                            </select> phút
                            
                            <select name="time_delay_second">
                            <?php 
                                for($i=0;$i<=59;$i++)
                                {
                                    ?>
                                    <option <?php if($attr['time_delay_second'] == $i) echo 'selected' ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php
                                }
                            ?>
                            </select> giây
                        </div>
                        
                         
                    </div>
                </div>
            
            <?php 
                $time_info = models_DB::get('SELECT * FROM ' . EXTENSION_TABLE . ' WHERE name=\'PopupForm\' AND display_position=\'begin\'' );
                
                //h($time_info);
               
                if(empty($time_info)) $time_info = array(
                    'repeat_time_day'   => 0,
                    'repeat_time_hour'   => 0,
                    'repeat_time_minute'   => 0,
                    'repeat_time_second'   => 0
                );
                else
                {
                    $time_info = json_decode($time_info[0]['attributes'], TRUE);
                }
                
            ?>
            
            
            
            <div class="new-thread-item box">
                
                <div class="new-thread-item box">
                      <div class="field-item clearfix">
                        <div class="field-title">
                            <label class="label block">Chọn Kiểu Form</label>
                        </div>
                        
                        <div >
                         <div class="preview-guider">
                            <i>( Quan sát Form trên màn hình )</i>
                         </div>
                            <?php
                                ///for($i=1;$i<=4;$i++)
                                $i = 1;
                                while( file_exists( dirname(__FILE__) . '/display-' . $i . '.php' ) )
                                {
                                    ?>
                                    <div class="none css-style css-style-<?php echo $i ?>">
                                    <?php include_once 'style-' . $i . '.php'; ?>
                                    </div>
                                    <div class="display_style-item">                                    
                                        <div class="display-<?php echo $i ?> display <?php if( $default_value['display_style'] != $i) echo ' none ' ?>"><?php include 'display-' . $i . '.php' ?></div>
                                        <input id="display_style-<?php echo $i ?>" class="display_style-radio pointer"  name="display_style" <?php if( $default_value['display_style'] == $i) echo ' checked ' ?> value="<?php echo $i ?>" type="radio" />
                                        <label for="display_style-<?php echo $i ?>" class="block pointer">Kiểu <?php echo $i ?></label>                                    
                                    </div>
                                    <?php
                                    $i++;
                                }
                                
                            ?>
                        </div>
                        
                         
                    </div>
                    
                </div>
                
                <div class="field-item clearfix none">
                    <div class="field-title">
                        <label class="label block">Vị trí hiển thị</label>
                    </div>
                         
                    <div class="field-content">
                        <select name="display_position_time">
                            <option value="begin">Trước thẻ DOCTYPE</option>
                        </select>
                    </div>
                </div>
            
                <div class="field-item clearfix">
                    <div class="field-title">
                        <label class="label block">Thời gian lặp lại popup</label>
                    </div>
                    
                    <div class="time-for">
                        <select name="time_day">
                        <?php 
                            for($i=0;$i<=30;$i++)
                            {
                                ?>
                                <option <?php if($time_info['repeat_time_day'] == $i) echo 'selected' ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php
                            }
                        ?>
                        </select> ngày
                        <select name="time_hour">
                        <?php 
                            for($i=0;$i<=23;$i++)
                            {
                                ?>
                                <option <?php if($time_info['repeat_time_hour'] == $i) echo 'selected' ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php
                            }
                        ?> 
                        </select> giờ
                        <select name="time_minute">
                        <?php 
                            for($i=0;$i<=59;$i++)
                            {
                                ?>
                                <option <?php if($time_info['repeat_time_minute'] == $i) echo 'selected' ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php
                            }
                        ?>
                        </select> phút
                        
                        <select name="time_second">
                        <?php 
                            for($i=0;$i<=59;$i++)
                            {
                                ?>
                                <option <?php if($time_info['repeat_time_second'] == $i) echo 'selected' ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php
                            }
                        ?>
                        </select> giây
                    </div>
                    
                     
                </div>
                
            </div>
            
            
            <div class="new-thread-item box">
                  <div class="field-item clearfix">
                    <div class="field-title">
                        <label class="label block">Chọn Form</label>
                    </div>
                    
                    <div >
                        <select name="form_id" style="padding: 5px 10px;min-width:200px" class="text form-control parameter">
                        
                        
                        <?php 
                            $list_forms = get_forms(array('the_type'=>'form'));
                            foreach($list_forms as $list_form)
                		    {
                		        ?>
                                <option <?php if( $list_form['id']  == $attr['form_id']) echo 'selected' ?>  value="<?php echo $list_form['id'] ?>"><?php echo $list_form['name'] ?></option>
                                <?php  
                            }
                        ?>
                        </select>
                    </div>
                    
                     
                </div>
                
            </div> 
            
            <div class="new-thread-item box">
                  <div class="field-item clearfix">
                    <div class="field-title">
                        <label class="label block">Vị trí hiển thị</label>
                    </div>
                    
                    <div >
                        <select name="form_position" style="padding: 5px 10px;min-width:200px" class="form_position text form-control parameter">
                             
                            <option type=".list-instance-item-bottom, .list-instance-item-left" <?php if( 'bottom_left'  == $default_value['form_position']) echo 'selected' ?>  value="bottom_left">Góc dưới bên trái</option>
                            <option type=".list-instance-item-bottom, .list-instance-item-right" <?php if( 'bottom_right'  == $default_value['form_position']) echo 'selected' ?> value="bottom_right">Góc dưới bên phải</option>
                            <option type=".list-instance-item-top, .list-instance-item-left" <?php if( 'top_left'  == $default_value['form_position']) echo 'selected' ?> value="top_left">Góc trên bên trái</option>
                            <option type=".list-instance-item-top, .list-instance-item-right" <?php if( 'top_right'  == $default_value['form_position']) echo 'selected' ?> value="top_right">Góc trên bên phải</option> 
                               
                        </select>
                    </div>
                    
                    <div class="list-instance clearfix">
                        <div class="fl list-instance-item  list-instance-item-top v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-6 v-col-tx-6" >
                            Cách lề trên <input value="<?php echo $default_value['top'] ?>" type="number" name="top" />  ( px )
                        </div>
                        <div class="fl list-instance-item  list-instance-item-bottom v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-6 v-col-tx-6" >
                            Cách lề dưới <input value="<?php echo $default_value['bottom'] ?>" type="number" name="bottom" /> ( px )
                        </div>
                        <div class="fl list-instance-item  list-instance-item-left v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-6 v-col-tx-6" >
                            Cách lề trái <input value="<?php echo $default_value['left'] ?>" type="number" name="left" /> ( px )
                        </div>
                        <div class="fl list-instance-item  list-instance-item-right v-col-lg-6 v-col-md-6 v-col-sm-6 v-col-xs-6 v-col-tx-6" >
                            Cách lề phải <input value="<?php echo $default_value['right'] ?>" type="number" name="right" /> ( px )
                        </div>
                        
                    </div>
                    
                      
                </div>
                
            </div> 
</div>