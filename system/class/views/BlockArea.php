<?php
class views_BlockArea
{   
    public function __construct()
    {
         
    }
    public static function display_area($block_area_name, $block_title_wrap = 'div', $delete_icon = TRUE, $add_block=TRUE)
    {
         
        global $global_admin;
        global $global_user;
        global $g_page_info;
        $obj_DB= new models_DB;
        $block_area_content = $obj_DB->get('SELECT * FROM '. BLOCK_AREA_TABLE .' WHERE url=\'' . $block_area_name . '\'');
        
        
        
        if(empty($block_area_content)) $block_id = 0;
        else $block_id =   $block_area_content[0]['id'];  
           
           
            
        ?>
        <div <?php if(USER_PERMISSION =='admin' ) {echo ' block_area_id="' . $block_id . '" '; }  ?> class=" <?php if(!$delete_icon) echo 'no-delete'; ?> <?php if(!$add_block) echo 'no-add'; ?> block_area_<?php echo $block_id ?> block_area  area_<?php echo $block_area_name ?><?php if($global_user['permission'] == 0) echo ' sortable' ?> clearfix" block_area_name="<?php echo $block_area_name ?>">
            <?php
            
            if(!empty($block_area_content[0]['content']))
            {
                $block_area_content = explode(',', $block_area_content[0]['content']);
                if(!empty($block_area_content))
                {
                    foreach($block_area_content as $v)
                    {
						
                        $block_content = $obj_DB->get('SELECT * FROM '.BLOCK_TABLE.' WHERE id = ' . $v);
						
					   if(empty($block_content)) continue;
						
                        $block_content = $block_content[0];
                        //echo $block_content['parameter'];die();
						
						//if($block_content['name'] != 'html') $block_content['parameter'] = preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $block_content['parameter']);
						
						$temporary_setting_parameter = json_decode($block_content['parameter'], TRUE);
						
						//h($temporary_setting_parameter);
						 
                        //$current_block_id = $v;
						
						$block_param = array(
							'block_id'		=> $v,
							'block_name'	=> $block_content['name'],
							'block_title'	=> $temporary_setting_parameter['title']
							);
						?>
						<div  <?php block_attribute($block_param) ?>>
						<?php
                        include PATH_ROOT . '/blocks/' . $block_content['name'] . '/display.php';
                        if( file_exists(PATH_ROOT . '/blocks/' . $block_content['name'] . '/include-display-css.php') ) include_once PATH_ROOT . '/blocks/' . $block_content['name'] . '/include-display-css.php' ;
						?>
						</div>
						<?php
                    } 
                }               
            }
            if(empty($block_area_content))
            {
                $insert_content = array(
                    'url'           => $block_area_name,
                    'name'          => $block_area_name,
                    'page_type'     => $g_page_info['page_type'],
                    'page_id'       => $g_page_info['page_id'],
                );
                $insert_id = models_DB::insert($insert_content, BLOCK_AREA_TABLE);
            }	
            ?>
        </div>    
        <?php
    }
    
    public static function display_block($block_id)
    {
        global $global_admin;
        $obj_DB= new models_DB;
        $block_content = $obj_DB->get('SELECT * FROM '.BLOCK_TABLE.' WHERE id = ' . $block_id);
		
		//h($block_content);
        $block_content = $block_content[0];
        $temporary_setting_parameter = json_decode($block_content['parameter'], TRUE);
		
		h($temporary_setting_parameter);
        
        $current_block_id = $block_id;
        include PATH_ROOT . '/blocks/' . $block_content['name'] . '/display.php';
    }
}