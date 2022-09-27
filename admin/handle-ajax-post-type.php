<?php
//session_start(); 
if(!defined('SECURE_CHECK')) die('Stop');

if(!user_can('post-type')) die();

$obj_DB = new models_DB;

if($g_user['permission'] != 'admin') die();
 
if(isset($_POST['type']) && $_POST['type']=='before_add_field')
{
    $post_type_id = $_POST['post_type_id'];
    $obj_DB = new models_DB;
    
    $insert_content = array(
        'init'          => 0,
        'attribute'     => 0,
        'stt'           => 0,
        'post_type'     => 0,
        'page_type'     => 0,
        'tab_display'   => 0,
        'the_status'    => 0
    );
    
    $field_id = models_DB::insert($insert_content, FIELD_TABLE);
    
    models_DB::delete(FIELD_TABLE, ' WHERE id=' . $field_id);
    
    $field_id++;
      
    ?>
    <div id="field-<?php echo $field_id ?>" field_id="<?php echo $field_id ?>" class="field" field_type="<?php echo $_POST['field_type'] ?>">
        <div class="field_title">
        <span class="title-area"></span>
        <i class="fa fa-sort-desc fr"></i>
        <span class="fr title-file-type"><?php echo $_POST['field_type'] ?></span>
        </div>
        
    <div class="field_content" style="display: block;">
    <?php
    
    include 'post_type/' .  $_POST['field_type'] . '/setting_form.php';
    ?>
    <div class="tab-display-wrap">
        <label>Tab display : </label>
        
        <select class="tab-display">
            <option value="other">Other</option>
            <option value="general">General</option>
            <option value="seo">SEO</option>
        </select>
        
        <span class="clear"></span>
    </div>
    
    
        <span class="btn btn-info add" field_id="<?php echo $field_id ?>">add</span>
        <span class="cancel btn btn-danger">Cancel</span>
        </div>
    </div>
    <?php
}


if(isset($_POST['type']) && $_POST['type']=='add_field')
{   
     
    //sleep(1);
    $attribute = array_combine($_POST['key'], $_POST['value']);
    
     if(!preg_match('/^[a-zA-Z0-9_]{1,31}$/', $attribute['name'])) 
     {
         echo 'field-name-invalid';die();
     }           
     
     switch($_POST['page_type'])
     {
        case 'post' :
        {
            $table_to_modify = POST_TABLE;
        }
        break;
        case 'category' :
        {
            $table_to_modify = CATEGORY_TABLE;
        }
        break;
        case 'tag' :
        {
            $table_to_modify = TAG_TABLE;
        }
        break;
        
     }
     
     $temp = "SHOW COLUMNS FROM `" . $table_to_modify . "` LIKE '" . $attribute['name'] . "'";
    
     
    
    $result = $global_sqli->query($temp);
     
    $exists = ($result->num_rows)?TRUE:FALSE;
    
    if($exists) 
    {
       echo 'field-exits';die(); 
    }
    
     
    
    $insert_content = array(
        'init'          => '0',
        'attribute'     => json_encode($attribute),
        'stt'           => 1,
        'post_type'     => $_POST['post_type_id'],
        'page_type'     => $_POST['page_type'],
        'tab_display'   => $_POST['tab_display'],
        'the_status'    => 'publish',
        'field_name'    => $attribute['name']
    );
    
    $field_id = models_DB::insert($insert_content, FIELD_TABLE);
    
    if($field_id)
    {
        $moment = 'ALTER TABLE  ' . $table_to_modify . ' ADD ' . $attribute['name'] . ' TEXT';
        $obj_DB->query_string($moment);
        echo '1';
    }
    
}


if(isset($_POST['type']) && $_POST['type']=='update_field')
{
    $obj_DB = new models_DB;
   
    $attribute = array_combine($_POST['key'], $_POST['value']);
    
    
    
    switch(true)
    {
        case (1) :
        {
            $insert_content = array( 
                'attribute'         => json_encode($attribute),
                'tab_display'   => $_POST['tab_display']
            );
            
        }
        break;
        
        
    }
    $result = $obj_DB->update($insert_content, FIELD_TABLE, ' WHERE id='.$_POST['field_id']);
    if($result) echo 'success';else echo 'Error';
    ?>
    
    
        
    <?php
}


if(isset($_POST['type']) && $_POST['type']=='change_stt')
{
    $obj_DB = new models_DB;
    
     
    foreach($_POST['value'] as $k=>$v)
    {
        $obj_DB->update(array('stt'=>$k + 20),   FIELD_TABLE, ' WHERE id='.$v);
    }
}


if(isset($_POST['type']) && $_POST['type']=='delete_field')
{
     
    $obj_DB = new models_DB;
    
    $field = get_field($_POST['field_id']);
    
    $attribute = json_decode($field['attribute'], TRUE);
    
    if($field['init']) die('Can\'t delete this field');
    /**
     * delete field
     */
    
    switch($_POST['page_type'])
     {
        case 'post' :
        {
            $table_to_modify = POST_TABLE;
        }
        break;
        case 'category' :
        {
            $table_to_modify = CATEGORY_TABLE;
        }
        break;
        case 'tag' :
        {
            $table_to_modify = TAG_TABLE;
        }
        break;
        
     }
   
    $moment = 'ALTER TABLE '. $table_to_modify . ' DROP COLUMN '. $attribute['name'];
    $result2 = $obj_DB->query_string($moment);
    
    
    /**
     * END
     */
     
     
    /**
     * delete field
     */
    $moment = 'DELETE FROM '. FIELD_TABLE .' WHERE id=' .  $_POST['field_id'];
    $result1 = $obj_DB->query_string($moment);
    /** END **/

    if($result1&&$result2) echo 'success';
}

if(isset($_POST['type']) && $_POST['type']=='delete_post_type')
{

    $moment = 'DELETE FROM ' . POST_TYPE_TABLE .' WHERE id=' .  $_POST['post_type_id'];
    $result1 = models_DB::query_string($moment);
       
    $moment = 'DELETE FROM ' . FIELD_TABLE . ' WHERE post_type=\'' . $_POST['post_type_id'] . '\'';

    $result3 = models_DB::query_string($moment);
    
    
    
    if($result1&&$result2&&$result3) echo '1';else echo $moment;
}


