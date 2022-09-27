<?php
    if(!defined('SECURE_CHECK')) die('Invalid to include');
	
    
    
    
    if(!user_can('edit-block-area')) die();
    
    if(!isset($_GET['block_area_id'])) die('block_area_id not defined !');
    
    if(!is_numeric($_GET['block_area_id'])) die('block_area_id invalid !');
    
    
	
    
    
    $block_area_id = $_GET['block_area_id'];
    
    $default_value = models_DB::get('  SELECT * FROM  ' . BLOCK_AREA_TABLE . ' WHERE id=' . $block_area_id);
    
    
    if(empty($default_value)) die('Block area not exits');
    else $default_value = $default_value[0];
    
    $g_page_content['title'] = 'Edit Block Area : ' . $default_value['name'];
 
if(isset($_POST['submit'])) 
{
	$success_notification = '';
    
    $default_value = array(
        'name'             => $_POST['name'],
        'url'               => $_POST['url'],
        'description'       => $_POST['description']
    );
    
    validate_value('stt','Order', FALSE, array('type'=>'number'));
    
    if(form_validation())
    {
        
        $insert_content['name'] = strip_tags($_POST['name']);
        
       
		if(!empty($_POST['url'])) $insert_content['url'] = $_POST['url'];
		
		else $insert_content['url'] = pretty_string(strip_tags($_POST['name']));
        $insert_content['description'] = $_POST['description'];
        
        $exist = models_DB::get('SELECT url FROM ' . BLOCK_AREA_TABLE . ' WHERE url=\'' . $insert_content['url'] .'\' AND id != ' . $block_area_id);
        
        if(!empty($exist)) $g_form_error_noti[] = 'Block area name exitst';
        else
        {
            $insert_id = models_DB::update($insert_content, BLOCK_AREA_TABLE, ' WHERE id=' . $block_area_id);
            if($insert_id) 
    		{
    		      $success_notification = 'Block area Updated';
    			//header('Location:' . SITE_URL . '/admin/edit-block-area/?block_area_id=' . $block_area_id);  
    		}
        }
        
        
        
        
		
		
    }
}
 	
//h($default_value);


?>

<?php
	include 'header.php';
?>

<div id="content" class="container">

    <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
        <div id="main-content" class="fl col-10-6">
            <div class="box">
          <div id="bread-crumbs" >
    			<a class="link" href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
    			<span class="arrow">›</span>
    			
    			
    			<a class="link" href="<?php echo SITE_URL ?>/admin/?page_type=block-area" >Block area</a>
    			<span class="arrow">›</span>
    			
    			<span class="current-page">Sửa block area &nbsp; <a  class="link" style="font-style:italic" href="<?php echo SITE_URL ?>/admin/?page_type=edit-block-area&block_area_id=<?php echo $block_area_id ?>"><?php echo $default_value['name'] ?></a></span>
    	
    		</div>
           </div>
            <form action="" method="POST">
                <div class="box">
                    <h2 class="title">Edit Block Area : "<?php echo $default_value['name'] ?>"</h2>
                     <?php show_form_error() ?>
                     
                     <?php 
                        if(!empty($success_notification))
                        {
                            ?>
                            <div style="" class="success-noti">
                                <?php echo $success_notification ?>
                            </div>
                            <?php
                        }
                     ?>
                     
                     <?php include 'inc/block-area-form.php'; ?>
                    
                    
                </div>
                
                <div id="save" class="box"><input type="submit" value="Edit" name="submit" class="btn btn-success" /></div>
            </form>
        </div>
    </div>
        
    
    <span class="clear"></span>
</div>