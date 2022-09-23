<?php
if(!defined('SECURE_CHECK')) die('Stop');

$temporary = explode('?', self::$url);
$real_url = $temporary[0];

if(URL_SUFFIX != '')
{
    $temporary = explode(URL_SUFFIX, $real_url);
    array_pop($temporary);
    $real_url = implode(URL_SUFFIX, $temporary);
}
else
{
    
}

 

$real_url_part = explode('/', $real_url);
$g_page_info['action'] = $real_url_part[0]; 
get_post_size();
 

if(($g_page_info['action'] == '') || ($g_page_info['action'] == 'index.php') || is_numeric($g_page_info['action']) ) 
{
    $g_page_info['page_type'] = 'home';
    if(empty($real_url_part[0])) $g_page_info['page'] = 1;
    else $g_page_info['page'] = $real_url_part[0];
     
} 
else
{
    $part = explode('-', $g_page_info['action']);
	$last_part = $part[count($part)-1];
	
	
	
	$real_part = str_split($last_part);
	
   
	 
	
	//h($g_page_info);die();
	  
	if(0) $g_page_info['page_type'] = '404'; //!is_numeric($real_part[1])
    
    else
	{
        if(empty($real_part[1]) || (!is_numeric($real_part[1])))
        {
             $g_page_info['page_type'] = '404';
        }
        else
        {
            switch($real_part[0])
			{
				case 'p' :
				{
					$g_page_info['page_type'] = 'post';
				}
				break;
				
				case 'c' :
				{
				   
					$g_page_info['page_type'] = 'category';
                    if(empty($real_url_part[1])) $g_page_info['page'] = 1;
                    else $g_page_info['page'] = $real_url_part[1];
				}
				break;
                
                case 't' :
				{
				   
					$g_page_info['page_type'] = 'tag';
                    if(empty($real_url_part[1])) $g_page_info['page'] = 1;
                    else $g_page_info['page'] = $real_url_part[1];
				}
				break;
				
				default : $g_page_info['page_type'] = '404';
			}
        }
		
		array_shift($real_part);
		$g_page_info['page_id'] = implode('', $real_part);
	}
	     
	
}

