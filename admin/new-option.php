<?php
    if(!defined('SECURE_CHECK')) die('Invalid to include');
	$g_page_content['title'] = 'New option';
    
    
    if(!user_can('new-option')) die();
 
if(isset($_POST['submit'])) 
{
    validate_value('name','Option name', FALSE, array('type'=>'user_name'));
    validate_value('maxlenght','Maxlengt', FALSE, array('type'=>'number'));
    validate_value('value','Value', FALSE, array('max_lenght'=>$_POST['maxlenght']));
    
    if(form_validation())
    {
        $insert_content = array(
            'name'          => $_POST['name'],
            'value'         => $_POST['value'],
            'is_default'    => 0,
            'display'       => 1,
            'attributes'    => json_encode(array('title'=>$_POST['title'], 'type'=>$_POST['type'], 'maxlenght'=>$_POST['maxlenght']))
        );
        
        models_DB::insert($insert_content, OPTION_TABLE);
        header('Location:' . SITE_URL . '/admin/?page_type=general');
    }
}
?>

<?php
	include 'header.php';
?>

<div id="content" class="container">

    <?php include 'sidebar.php'; ?>
        
    <div id="main-content" class="fl col-10-6">
       
      
       
        <form action="" method="POST">
            <div class="box">
                <h2 class="title">New option</h2>
                 <?php show_form_error() ?>
                <div class="option-item">
                    
                    <div class="option-content">
                        <label for="title" class="fl">Title</label>
                        <div class="field fl">
                            <input type="text" required="" name="title" id="title" value="<?php return_value('title', '', FALSE, FALSE) ?>" />
                        </div>
                        
                        <span class="clear"></span>
                    </div>
                </div>
                
                <div class="option-item">
                    <div class="option-content">
                        <label for="name" class="fl">Name</label>
                        <div class="field fl">
                            <input required="" type="text" name="name" id="name" value="<?php return_value('name', '', FALSE, FALSE) ?>" />
                        </div>
                        
                        <span class="clear"></span>
                    </div>
                </div>
             
             
                <div class="option-item">   
                    <div class="option-content">
                        <label for="type" class="fl">Type</label>
                        <div class="field fl">
                            <select  name="type" id="type">
                                <option value="text" <?php check_select('type', '', 'text') ?>>text</option>
                                <option value="textarea" <?php check_select('type', '', 'textarea') ?>>textarea</option>
                                <option value="select" <?php check_select('type', '', 'select') ?>>select</option>
                                <option value="checkbox" <?php check_select('type', '', 'text') ?>>checkbox</option>
                                <option value="image" <?php check_select('type', '', 'text') ?>>image</option>
                            </select>
                        </div>
                        
                        <span class="clear"></span>
                    </div>
                </div>   
                
                <div class="option-item">   
                    <div class="option-content">
                        <label for="value" class="fl">Value</label>
                        <div class="field fl">
                            <input type="text" name="value" id="name" value="<?php return_value('value', '', FALSE, FALSE) ?>" />
                        </div>
                        
                        <span class="clear"></span>
                    </div>
                </div>   
                
                <div class="option-item">   
                    <div class="option-content">
                        <label for="type" class="fl">Max lenght</label>
                        <div class="field fl">
                            <input type="number" required="" name="maxlenght" id="name" value="<?php return_value('maxlenght', '-1', FALSE, FALSE) ?>" />
                        </div>
                        
                        <span class="clear"></span>
                    </div>
                </div>    
                
                
                
                </div>
            
            <div id="save" class="box"><input type="submit" value="Add" name="submit" class="btn btn-success" /></div>
        </form>
    </div>
    <span class="clear"></span>
</div>