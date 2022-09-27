<?php
session_start();
define('SECURE_CHECK', true);

include dirname(dirname(__FILE__)).'/config.php';

if($g_user['permission'] != 'admin') die('');

if(!isset($_POST['type'])) die();



if($_POST['type']=='suggest_tex_field')
{   
    
     $field_values = models_DB::get('SELECT DISTINCT ' . $_POST['field_name']. '  FROM ' . POST_TABLE . ' WHERE  ' . $_POST['field_name']  . ' LIKE \'%' . $_POST['s'] .'%\'');
     
     if(!empty($field_values))
     {
        ?>
        <ul>
        <?php
        foreach($field_values as $field_value)
         {
            ?>
             
                <li class="suggest-text-field-item" field_id="<?php echo $_POST['field_id'] ?>"><?php echo $field_value[$_POST['field_name']] ?></li>
             
            <?php
         }
        ?>
        </ul>
        <?php
     }
     
}


 

 