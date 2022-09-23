<?php
	if(!defined('SECURE_CHECK')) die('Stop');
?>

<style>
        h1.title{
        font-size:20px;
        margin-left:230px;
    }
    h1.title span{
        color:rgb(48, 63, 231);
    }
    
    #content{
        padding:15px;
    }
    
    label{
        display:block;
        float:left;
        width:200px;
    }
    
    input{
        float:left;
        width:350px;
        padding:3px;
        border:1px solid silver;
        
    }
    .attribute_item {
        margin-bottom: 20px;
    }
    
    .field_title{
        background: url(images/arrow-down.png) no-repeat right -10px rgb(146, 151, 151);
        height: 30px;
        width: 100%;
        border: 1px solid silver;
        background-size: 40px;
        border-radius: 5px 5px 0 0;
        cursor: move;
        line-height: 30px;
        padding: 0 10px;
        color: rgb(255, 255, 255);
        }
        .field_content {
            border: 1px solid rgb(214, 214, 214);
            border-top: 0;
            padding:10px;
            display:none;
        }
        
    .field{
        margin-bottom: 30px;
        background:#fff;
    }
    textarea{
        width:350px;
        height:100px;    
        padding:5px;
    }
    
    .delete, .cancel{
        display:block;
        float:right;
    }
    .noti{
        -webkit-transition:all 1s;
        transition:all 1s;
        opacity:1;
    }
</style>

<h1 class="title">Edit post type : <span><?php echo $tpl->variable['post_type_title'] ?></span></h1>
<section class="fl sortable" id="content" post_type_id="<?php echo $_GET['post_type_id'] ?>">
    <?php
   	$moment = 'SELECT * FROM field WHERE  post_type=' . $_GET['post_type_id'] . ' ORDER BY stt ASC';
    $obj_DB = new models_DB;
    $fields = $obj_DB->get($moment);
    
    foreach($fields as $field)
    {
        $temporary_setting_parameter = unserialize($field['attribute']);
        $attribute = unserialize($field['attribute']);
    ?>
    
    <div field_id="<?php echo $field['id'] ?>" class="field" field_type="<?php echo $field['field_type'] ?>">
        <div class="field_title"><?php echo $attribute['field_title'] ?></div>
        
        <div class="field_content">
    <?php
        include 'post_type/'.$field['field_type']. '/setting_form.php';
        ?>
        <span class="btn btn-info update">Update</span>
        <span class="delete btn btn-danger">Delete</span>
        </div>
    </div>
        <?php
    }
    ?>
</section>

<section class="fr" id="list-post-type">
    <ul>
    <?php 
        $post_types = scandir( PATH_ROOT . '/admin/post_type');
        $num_post_type = count($post_types);
        for($i=2;$i<$num_post_type;$i++)
        {
            $file_type = pathinfo($post_types[$i]);
            ?>
            <li field_id="0" class="draggable" field_type="<?php  echo $file_type['filename'] ?>"><?php  echo $file_type['filename'] ?></li>
            <?php
        }
    ?>
    </ul>
</section>