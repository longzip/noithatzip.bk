<?php


if(!user_can('post-type')) die();

$obj_DB = new models_DB;

if($g_user['permission'] != 'admin') die();

//h($_POST);

if(isset($_POST['type']) && $_POST['type']=='before_add_field')
{
    $post_type_id = $_POST['post_type_id'];
    $obj_DB = new models_DB;
    
    $insert_content = array(
        'the_type'              => '',
        'field_attribute'       => '',
        'field_stt'             => '',
        'field_form'            => '',
        'time_create'           => hcv_time(),
        'field_slug'            => ''
    );
    
    $field_id = models_DB::insert($insert_content, FORM_TABLE);
    
    models_DB::delete(FORM_TABLE, ' WHERE id=' . $field_id);
    
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
         //echo 'field-name-invalid';die();
     }           
     
     $table_to_modify = FORM_TABLE;
     
     if(empty($attribute['name'])) $attribute['name'] = pretty_string($attribute['title'], '_');
    $attribute['name'] = pretty_string($attribute['name'], '_');
     
    $exists = get_forms(array( 'field_form'=> $_POST['form_id'], 'field_slug'=> $attribute['name'] ));
    
    //h($exists);
    
    if( ! empty($exists)) 
    {
       echo 'field-exits';die(); 
    }
    
    
    
    $insert_content = array(
        'the_type'      => 'field',
        'field_attribute'     => json_encode($attribute),
        'field_stt'           => 1,
        'field_form'     => $_POST['form_id'],
        'time_create'    => hcv_time(),
        'field_slug'        => $attribute['name'],
        'field_name'        => $attribute['title'],
        'field_type'        => $attribute['field_type']
    );
    
     
    
    $field_id = models_DB::insert($insert_content, FORM_TABLE);
    
    if($field_id)
    {
         
        echo 'success';
    }
     
}


if(isset($_POST['type']) && $_POST['type']=='update_field')
{
    $obj_DB = new models_DB;
    
    //h($_POST);
    
    $attribute = array_combine($_POST['key'], $_POST['value']);
    
    
    
    switch(true)
    {
        case (1) :
        {
            $insert_content = array( 
                'field_attribute'         => json_encode($attribute),
                'field_name'              => $attribute['title']
            );
             
        }
        break;
        
        
    }
    $result = $obj_DB->update($insert_content, FORM_TABLE, ' WHERE id='.$_POST['field_id']);
    if($result) echo 'success';else echo 'Error 1';
    ?>
    
    
        
    <?php
}


if(isset($_POST['type']) && $_POST['type']=='change_stt')
{
    $obj_DB = new models_DB;
    
     
    foreach($_POST['value'] as $k=>$v)
    {
        $obj_DB->update(array('field_stt'=>$k + 20),   FORM_TABLE, ' WHERE id='.$v);
    }
}


if(isset($_POST['type']) && $_POST['type']=='delete_field')
{
    
    
    /**
     * delete field
     */
    $moment = 'DELETE FROM '. FORM_TABLE .' WHERE id=' .  $_POST['field_id'];
    
    
    
    $result1 = models_DB::query_string($moment);
    /** END **/

    if($result1) echo 'success';
}

if(isset($_POST['type']) && $_POST['type']=='delete_post_type')
{

    $moment = 'DELETE FROM ' . POST_TYPE_TABLE .' WHERE id=' .  $_POST['post_type_id'];
    $result1 = models_DB::query_string($moment);
       
    $moment = 'DELETE FROM ' . FORM_TABLE . ' WHERE post_type=\'' . $_POST['post_type_id'] . '\'';

    $result3 = models_DB::query_string($moment);
    
    
    
    if($result1&&$result2&&$result3) echo '1';else echo $moment;
}


///////////////
if(isset($_POST['type']) && $_POST['type']=='delete_form')
{

    $moment = 'DELETE FROM ' . FORM_TABLE .' WHERE id=' .  $_POST['form_id'];
    $result1 = models_DB::query_string($moment);
     
    if($result1) echo '1';else echo $moment;
}

if(isset($_POST['type']) && $_POST['type']=='delete_order')
{

    $moment = 'DELETE FROM ' . FORM_TABLE .' WHERE id=' .  $_POST['order_id'];
    $result1 = models_DB::query_string($moment);
     
    if($result1) echo '1';else echo $moment;
}
