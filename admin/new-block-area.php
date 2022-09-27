<?php
    if(!defined('SECURE_CHECK')) die('Invalid to include');
	$g_page_content['title'] = 'New Block Area';
	
    
    if(!user_can('new-block-area')) die();
    
    
if(isset($_POST['submit'])) 
{
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
        
        $exist = models_DB::get('SELECT url FROM ' . BLOCK_AREA_TABLE . ' WHERE url=\'' . $insert_content['url'] .'\'');
        
        if(!empty($exist)) $g_form_error_noti[] = 'Block area name exitst';
        else
        {
            $insert_content['description'] = $_POST['description'];
         
            $insert_id = models_DB::insert($insert_content, BLOCK_AREA_TABLE);
            if($insert_id) 
    		{
    			header('Location:' . SITE_URL . '/admin/?page_type=block-area');  
    		}
        } 
        
        
		
		
    }
}
else
{
    $default_value = array(
        'name'             => '',
        'url'               => '',
        'description'       => ''
    );
}
?>

<?php
	include 'header.php';
?>

<div id="content" class="container">

    <?php include 'sidebar.php'; ?>
        
    <div id="main-content" class="fl col-10-6">
       <div id="bread-crumbs" class="box">
			<a class="link" href="<?php echo SITE_URL ?>/admin">Trang chủ quản trị</a>
			<span class="arrow">›</span>
			
			
			<a class="link" href="<?php echo SITE_URL ?>/admin/?page_type=block-area" >Block area</a>
			<span class="arrow">›</span>
			
			
	
		</div>
      
       
        <form action="" method="POST">
            <div class="box">
                <h2 class="title">New Block Area</h2>
                 <?php show_form_error() ?>
                 
                 <?php include 'inc/block-area-form.php'; ?>
                
                
            </div>
            
            <div id="save" class="box"><input type="submit" value="Add" name="submit" class="btn btn-success" /></div>
        </form>
    </div>
    <span class="clear"></span>
</div>