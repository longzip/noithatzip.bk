<?php
	if(!defined('SECURE_CHECK')) die('Stop');
?>

<div id="form_content" class="col-xs-8 col-md-10 text-left clearfix">
     
     <form  role="form"  action="" method="POST">
        <h1 class="page-title">
        <?php 
            $post_type_name = get_post_type($global_current_row['post_type_id']);
            
            if($global_current_row['action'] == 'edit_post') 
            {
                ?>
                Edit post : <a href="<?php echo SITE_URL, '/' , $global_current_row['post_url'], '-', $global_current_row['post_type_id'], URL_SUFFIX_SEPARATE, $global_current_row['post_id'] ?>"><?php echo $global_current_row['post_title'] ?></a>
                <span>in post type</span>   <?php echo $post_type_name['name']; ?>
                <?php
            }
            else echo 'Add new post <span>in post type</span>  ' . $post_type_name['name'];
        ?>
        </h1>
        <?php if(isset($error_notification) && ($error_notification != '')) : ?>
        <p style="padding: 5px 10px;margin-top:10px;" class="form-group bg-danger">
        
        <?php 
        foreach($error_notification as $v)
        {
           echo $v;
        }
        ?>
        </p>
        <?php endif;  ?>
        
        
        <?php if(isset($_COOKIE['success_notification'])) : ?>
        <p style="padding: 5px 10px;margin-top:10px;" class="form-group bg-success"><?php echo $_COOKIE['success_notification']; ?></p>
        <?php endif;  ?>
                    
        
        
        <?php if(isset($success_notification) && ($success_notification != '')) : ?>
        <p style="padding: 5px 10px;margin-top:10px;" class="form-group bg-success"><?php echo $success_notification ?></p>
        <?php endif;  ?>
        
        <?php 
            $obj_DB = new models_DB;
            
            
            foreach($default_fields as $k=>$v)
            {

                $attribute = unserialize($v['attribute']);  
                
                if(!isset($attribute['description'])) $attribute['description'] = '';
                include PATH_ROOT . '/admin/post_type/' . $v['field_type'] . '/post_form.php';       
                
            }
            
            foreach($fields as $k=>$v)
            {

                $attribute = unserialize($v['attribute']);  
                
                if(!isset($attribute['description'])) $attribute['description'] = '';
                include PATH_ROOT . '/admin/post_type/' . $v['field_type'] . '/post_form.php';       
                
            }
        ?>
        <div class="col-xs-12 form-box">
            <input type="submit" class="btn btn-info" value="<?php echo $global_current_row['submit_text'] ?>" name="submit_post_content" />
        </div>
        <span class="clear"></span>
    </form>
</div>



