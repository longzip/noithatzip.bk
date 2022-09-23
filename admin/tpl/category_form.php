<?php
	if(!defined('SECURE_CHECK')) die('Stop');
    
    $obj_DB = new models_DB;
    
    
    if($global_current_row['action']=='edit_category')
    {
        $get_the_categorys = $obj_DB->get('SELECT * FROM ' . TERM_TABLE . ' WHERE parent !=' . $global_current_row['category_id'] . ' AND id != ' . $global_current_row['category_id']);
        
        
        $this_category = $obj_DB->get('SELECT * FROM ' . TERM_TABLE . ' WHERE id='. $global_current_row['category_id']);
        $this_category = $this_category[0];
    }
    else
    {
        $get_the_categorys = $obj_DB->get('SELECT * FROM ' . TERM_TABLE);
    }
    
?>

        <div id="form_content" class="col-xs-8 col-md-10 text-left clearfix">
             
             <form  role="form"  action="" method="post">
                <h1>
                <?php 
                    if($global_current_row['action'] == 'edit_category')
                    {
                        ?>
                        Edit Category : <a href="<?php echo SITE_URL, '/',  $global_current_row['category_url'], '-c', $global_current_row['category_id'] ?>"><?php echo $global_current_row['category_name'] ?></a>
                        <?php
                    }
                    else
                    {
                        ?>
                        Add new category
                        <?php
                    }
                ?>
                </h1>
                
                <div class="col-xs-12">
                    <?php if(isset($error_notification) && ($error_notification != '')) : ?>
                    <p style="padding: 5px 10px;margin-top:10px;" class="form-group bg-danger"><?php echo $error_notification ?></p>
                    <?php endif;  ?>
                    
                    <?php if(isset($success_notification) && ($success_notification != '')) : ?>
                    <p style="padding: 5px 10px;margin-top:10px;" class="form-group bg-success"><?php echo $success_notification ?></p>
                    <?php endif;  ?>
                    
                    <?php if(isset($_COOKIE['success_notification'])) : ?>
                    <p style="padding: 5px 10px;margin-top:10px;" class="form-group bg-success"><?php echo $_COOKIE['success_notification']; ?></p>
                    <?php endif;  ?>
                    
                    

                    
                    <p class="form-group form-box">
                    <label class="" for="name">Tiêu đề</label>
                    <br />
                    <input class="form-control the_title" id="category_title" value="<?php echo $category_fields['title'] ?>" type="text" name="category_title" /><br />
                    <input style="width: 100%;" class="the_url" placeholder="Url" id="category_url" value="<?php echo $category_fields['url'] ?>" type="text" name="category_url" />
                    <span class="clear"></span>
                    </p><br />
                    
                     
                    <p class="form-group form-box">
                        <label class="" for="category_description">Miêu tả</label>
                        <br />
                        <textarea class="main-content" style="width: 98%;max-width:98%;min-height:200px" id="category_description" name="category_description"><?php echo $category_fields['description'] ?></textarea>
                        <noscript>Javascript is disable. Use only html mode.</noscript>
                    </p><br />
                    
                    <p class="form-group form-box">
                        <label class="" for="category_description">Seo Title</label>
                        <br />
                        <textarea style="width: 98%;max-width:98%;min-height:60px" id="seo_title" name="seo_title"><?php echo $category_fields['seo_title'] ?></textarea>
                        
                    </p><br />
                    
                    
                    <p class="form-group form-box">
                        <label class="" for="seo_description">Seo Description</label>
                        <br />
                        <textarea style="width: 98%;max-width:98%;min-height:60px" id="seo_description" name="seo_description"><?php echo $category_fields['seo_description'] ?></textarea>
                        
                    </p><br />
                    
                </div>
                
                <div class="col-xs-12">
                    
                
                    <p class="form-group form-box">
                        <label class="category_feature_image" for="category_image">Ảnh đại diện</label>
                        <br />
                        <input type="text" value="<?php echo $category_fields['image'] ?>" id="category_image" name="category_image" />
                       
                        <span class="show-media-frame btn btn-info" particular="category_image">Chọn ảnh</span>
                         <br /><img id="category_image_display" style="max-width: 100%;" src="<?php echo $category_fields['image'] ?>" />
                    </p><br />
                    
                    
                    <div class="form-group form-box">
                        <label class="categories" for="categories">Chuyên mục cha</label>
                        
                        <select class="form-control" name="parent_category">
                            <option value="">None</option>
                        <?php
                            if(!empty($get_the_categorys))
                            {
                                foreach($get_the_categorys as $v_key => $v_value)
                                {
                                    ?>
                                        
                                    <option <?php if($category_fields['parent'] == $v_value['id'] ) echo 'selected' ?> value="<?php echo $v_value['id'] ?>"><?php echo $v_value['title'] ?></option>
                            
                            
                                    <?php
                                }
                            }
                            
                        ?>
                        </select>
                        <span class="clear"></span>
                    </div><br />
                    
         
                    <div class="form-box form-group ">
                       
                        <input class="btn btn-primary" name="submit_category_content" id="submit_category_content" type="submit" value="<?php echo 'add' ?>" />
                    </div>
                    

                
                </div>
                <span class="clear"></span>
            </form>

        </div>
    
