<?php
session_start();
define('SECURE_CHECK', TRUE);

include dirname(dirname(__FILE__)) . '/config.php';



if($g_user['permission'] != 'admin') die();

if(isset($_POST['type']) && $_POST['type']=='before-edit-meta')
{
     
    $value = '';
    switch($_POST['page_type'])
    {
        case 'post' :
        {
            $info = get_post($_POST['the_id'], $_POST['field']);
        }
        break;
        
        case 'category' :
        {
            $info = get_category($_POST['the_id'], $_POST['field']);
        }
        break;
        
        case 'tag' :
        {
            $info = get_tag($_POST['the_id'], $_POST['field']);
        }
        break;
    }
     
    $value = $info[$_POST['field']];
    ?>
    <div class="wrap-core-edit-meta-input  wrap-core-input-text the_id-<?php echo $_POST['the_id'] ?>  field-<?php echo $_POST['field'] ?>   page_type-<?php echo $_POST['page_type'] ?> ">
    <?php
    switch($_POST['field_type'])
    {
        case 'text' :
        {
            ?>
            <input class="core-edit-meta-input core-input-text" type="text" value="<?php echo $value ?>"  />
            <?php
        }
        break;
        
        case 'textarea' :
        {
            $info = get_category($_POST['id'], $_POST['field']);
        }
        break;
        
        case 'html' :
        {
            $info = get_tag($_POST['id'], $_POST['field']);
        }
        break;
    }
    
    ?>
         <button class="core-edit-meta-save" page_type="<?php echo $_POST['page_type'] ?>" field="<?php echo $_POST['field'] ?>" the_id="<?php echo $_POST['the_id'] ?>" field_type="<?php echo $_POST['field_type'] ?>">Luu</button>
    </div>
    <?php
}

if(isset($_POST['type']) && $_POST['type']=='edit-meta')
{
    
    $update = array($_POST['field'] => $_POST['content']);  
    //h($_POST);
    switch($_POST['page_type'])
    {
        case 'post' :
        {
            models_DB::update($update, POST_TABLE, ' WHERE id=' . $_POST['the_id'] );
        }
        break;
        
        case 'category' :
        {
            models_DB::update($update, CATEGORY_TABLE, ' WHERE id=' . $_POST['the_id'] );
        }
        break;
        
        case 'tag' :
        {
            models_DB::update($update, TAG_TABLE, ' WHERE id=' . $_POST['the_id'] );
        }
        break;
    }
    
    $param = array(
            'field'         => $_POST['page_type'],
            'wrap'          => 'h1',
            'field_type'    => $_POST['field_type'],
            'id'            => $_POST['the_id'],
            'page_type'     => $_POST['page_type'],
            'default'       => $_POST['content']
        );
        display_meta($param);
}

if(isset($_POST['type']) && $_POST['type']=='load_form_setting')
{ 
    ?>
    <div id="dialog" title="<?php echo $_POST['block_name'] ?>">
         
        <iframe  width="890" height="450" src="<?php echo SITE_URL ?>/admin/?page_type=block-setting-form&block_name=<?php echo $_POST['block_name'] ?>"></iframe>
    </div>
    <?php
}

if(isset($_POST['type']) && $_POST['type']=='update_setting')
{
    $obj_DB = new models_DB;
    $current_block = $obj_DB->get('SELECT * FROM ' . BLOCK_TABLE . ' WHERE id='.$_POST['block_id']);
    //
    $current_block_name = $current_block[0]['name'];
    
     
     
     
    ?>
    <div id="dialog" title="<?php echo $current_block_name ?>">
         
	     <iframe width="890" height="450" src="<?php echo SITE_URL ?>/admin/?page_type=block-setting-form.php&block_name=<?php echo $current_block_name ?>&block_id=<?php echo $_POST['block_id']; ?>"></iframe>
    </div> 
    <?php
}

if(isset($_POST['type']) && $_POST['type']=='delete_block')
{
    $obj_DB = new models_DB;
    $current_block = $obj_DB->query_string('DELETE FROM '.BLOCK_TABLE.' WHERE id='.$_POST['block_id']);
    
    if($current_block) echo '1';
    else echo '0';
}



if(isset($_POST['type']) && $_POST['type']=='save_setting')
{

   if($_POST['form_type'] == 'array')
   {
	   $temporary_setting_parameter['title'] = $_POST['block_title'];
       $temporary_setting_parameter['title_link'] = $_POST['block_title_link'];
       foreach($_POST['key'] as $k=>$v)
       {
            $temporary_setting_parameter[] = array_combine($_POST['key'][$k], $_POST['value'][$k]);
       }
   }
   
   if($_POST['form_type'] == 'form')
   {
        $temporary_setting_parameter = array_combine($_POST['key'], $_POST['value']);
        
		$temporary_setting_parameter['title'] = $_POST['block_title'];
        $temporary_setting_parameter['title_link'] = $_POST['block_title_link'];
   }

    
   
   if($_POST['block_id'] == 0)
   {
        //h($temporary_setting_parameter);
        $obj_DB = new models_DB;
        $insert_content = array(
            'name'        => $_POST['block_name'],
            'parameter'   => json_encode($temporary_setting_parameter)
        );
        $current_block_id = $obj_DB->insert($insert_content, BLOCK_TABLE);
        
   }
   else
   {
        $obj_DB = new models_DB;
        $new_value = array(
            'name'        => $_POST['block_name'],
            'parameter'   => json_encode($temporary_setting_parameter)
        );
        $obj_DB->update($new_value, BLOCK_TABLE, ' WHERE id='.$_POST['block_id']);
        $current_block_id = $_POST['block_id'];
   }
		$block_param = array(
			'block_id'		=> $current_block_id,
			'block_name'	=> $_POST['block_name']
			);
		
		?>
		
		<div  <?php block_attribute($block_param) ?>>
		<?php
	   include PATH_ROOT . '/blocks/' . $_POST['block_name'] . '/display.php';
		?>
		</div>
		<?php
}



if(isset($_POST['type']) && $_POST['type']=='update_area_content')
{
    $obj_DB = new models_DB;
    $new_value = array(
        'content'   => $_POST['update_block_area_content']
    );
    if($obj_DB->update($new_value, BLOCK_AREA_TABLE, ' WHERE url =\''.$_POST['area_name'].'\'')) echo 'sucess roi';
    else echo 'loi roi';
}

if(isset($_POST['type']) && $_POST['type']=='change-direction')
{
    setcookie('wp_footer_direction', $_POST['change_direction'], time() + 86400 * 30, '/' );
}

if(isset($_POST['type']) && $_POST['type']=='loading_option')
{
    $option_info = get_option($_POST['option_name']);
      
    ?>
    <div id="dialog-option" class="popup-frame"  title="Ch???nh s???a Option <?php //echo $current_block_name ?>">
	     <iframe  src="<?php echo SITE_URL ?>/admin/?page_type=option_setting_form&option_name=<?php echo $_POST['option_name'] ?>"></iframe>
        <div class="action-option popup-frame-action">
            <span class="action-option-save popup-frame-action-save" par="<?php echo $_POST['option_name'] ?>">Save</span>
            <span class="action-option-close popup-frame-action-close">Close</span>
        </div>
    </div> 
    <?php
}

if(isset($_POST['type']) && $_POST['type']=='load_list_block')
{
    $block_area = models_DB::get( 'SELECT url FROM  ' . BLOCK_AREA_TABLE . ' WHERE id=' . $_POST['block_area_id'] );
    
     ?>
    <div id="dialog-option" class="popup-frame popup-frame-list-block-area" block_area_id="<?php echo $_POST['block_area_id'] ?>" block_area_name="<?php echo $block_area[0]['url'] ?>" title="Ch???n Block">
        
         
        <div class="edit-option-title">Ch???n Block</div>
        <div class="core-list-block clearfix">
            
            <div class="fl v-col-lg-5 v-col-md-6 v-col-sm-6 v-col-xs-12" id="core-list-block-col-1" >
                <div class="core-list-block-col-title"><span>Danh s??ch Block</span></div>
                <?php 
                    $actived_blocks = get_option('actived_blocks');
                    if(empty($actived_blocks)) $actived_blocks = array();
                    else $actived_blocks = json_decode($actived_blocks, TRUE);
    				foreach( scandir( PATH_ROOT . '/blocks' )  as $k=>$v ) 
    				{
    					if($k != '.' && $v != '..')
    					{
    					   
    					   if(!in_array($v, $actived_blocks)) continue;
    					   if( file_exists( PATH_ROOT . '/blocks/' . $v . '/title.txt' ) ) 
                           {
                                $myfile = fopen(PATH_ROOT . '/blocks/' . $v . '/title.txt', "r") or die("Unable to open file!");
                                $block_title = fread($myfile,filesize(PATH_ROOT . '/blocks/' . $v . '/title.txt'));
                                fclose($myfile);
                           }
                           else $block_title = $v;
    					   ?>
    						<div block_name="<?php echo $v ?>"  class="core-list-block-item core-list-block-item-<?php echo $v ?>">
                                    <span class="core-list-block-item-name"><?php echo $block_title ?></span>
                                    <span class="core-list-block-item-select" block_name="<?php echo $v ?>">Ch???n</span>                            
                            </div>
    						 
                            <?php 
    					}
    					
    				}
    			?>
            </div>
            <div class="fl v-col-lg-7 v-col-md-6 v-col-sm-6 v-xs-none v-tx-none" id="core-list-block-col-2" >   
                <div class="core-list-block-col-title"><span>Chi ti???t</span></div>
                <?php 
    				foreach( scandir( PATH_ROOT . '/blocks' )  as $k=>$v ) 
    				{
    					if($k != '.' && $v != '..')
    					{
    					   if( file_exists( PATH_ROOT . '/blocks/' . $v . '/description.txt' ) ) 
                           {
                                $myfile = fopen(PATH_ROOT . '/blocks/' . $v . '/description.txt', "r") or die("Unable to open file!");
                                $block_description = fread($myfile,filesize(PATH_ROOT . '/blocks/' . $v . '/description.txt'));
                                fclose($myfile);
                           }
                           else $block_description = '';
                           
                           if( file_exists( PATH_ROOT . '/blocks/' . $v . '/title.txt' ) ) 
                           {
                                $myfile = fopen(PATH_ROOT . '/blocks/' . $v . '/title.txt', "r") or die("Unable to open file!");
                                $block_title = fread($myfile,filesize(PATH_ROOT . '/blocks/' . $v . '/title.txt'));
                                fclose($myfile);
                           }
                           else $block_title = $v;
                           
                           $block_screenshot = '';
                           if( file_exists( PATH_ROOT . '/blocks/' . $v . '/sc.png' ) ) 
                           {
                                 $block_screenshot = SITE_URL . '/blocks/' . $v . '/sc.png';
                           }
                           echo CLIENT_ROOT . '/admin/images/block-sc-TitleImageLinkDescription.png';
                           if( file_exists( CLIENT_ROOT . '/admin/images/block-sc-TitleImageLinkDescription.png' ) )
                           {
                                $block_screenshot = SITE_URL . '/admin/images/block-sc-TitleImageLinkDescription.png';
                           }
                           
                           
    					   ?>
    						<div block_name="<?php echo $v ?>"  class="none core-list-block-description-item core-list-block-description-item-<?php echo $v ?>">
                                 <div class="core-list-block-description-item-title">Block <span><?php echo $block_title ?></span></div>
                                 <?php 
                                    if(!empty($block_description)) 
                                    {
                                        ?>
                                        <div class="core-list-block-description-item-description">
                                            <?php echo $block_description ?>
                                        </div>
                                        <?php
                                    }
                                 ?> 
                                  
                                 <?php 
                                    if(!empty($block_description)) 
                                    {
                                        ?>
                                        <div class="core-list-block-description-item-screenshot-title">V?? D???</span></div>
                                 
                                        <div class="core-list-block-description-item-screenshot">
                                            <img src="<?php echo $block_screenshot ?>" title="" alt="$block_title" />
                                        </div>
                                        <?php
                                    }
                                 ?>                          
                            </div>
    						 
                            <?php 
    					}
    					
    				}
    			?>
            </div>
        </div>
        <div class="popup-frame-action">
             <span class="popup-frame-action-close">Close</span>
        </div>
    </div> 
    <?php
}

if(isset($_POST['type']) && $_POST['type']=='save_option')
{
    $option_info = get_option($_POST['option_name']);
    
    update_option($_POST['option_name'], $_POST['value']);
}

?>