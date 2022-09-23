<?php 
if(!defined('SECURE_CHECK')) die('Stop');

$temporary = explode('?', self::$url);
$real_url = $temporary[0];

 

if(URL_SUFFIX != '')
{
	$special_page2 = array(SITE_URL . '/sitemap.xml', SITE_URL . '/post-sitemap.xml', SITE_URL . '/category-sitemap.xml', SITE_URL . '/tag-sitemap.xml', SITE_URL . '/robots.txt');

	
    $temporary = explode(URL_SUFFIX, $real_url);
	
	if(!in_array(CURRENT_URL, $special_page2))
	{
		array_pop($temporary);
	}
	
    
    $real_url = implode(URL_SUFFIX, $temporary);
	
	//die($real_url);
	
	
	
}
else
{
     
}

 
$special_page = array('search', 'filter', 'order', 'sitemap.xml', 'post-sitemap.xml', 'category-sitemap.xml', 'tag-sitemap.xml', 'robots.txt');


 
$real_url_part = explode('/', $real_url);
 
if(count($real_url_part) > 1)
{
    //echo $real_url_part[ count($real_url_part) -1  ];
    
	if( is_numeric($real_url_part[ count($real_url_part) -1  ]) )
	{
		$g_page_info['page'] = $real_url_part[ count($real_url_part) -1  ];
        //h($g_page_info);
		array_pop($real_url_part);
	}		
	else $g_page_info['page'] = 1;
		
	
	$url_in_sql = implode('/', $real_url_part);
	///$url_in_sql = $real_url;  // thêm ngày 14/6/2016
	$g_page_info['action'] = $url_in_sql;
}
else
{
	$url_in_sql = $real_url_part[0];
	$url_in_sql = $real_url;  // thêm ngày 14/6/2016
	$g_page_info['action'] = $url_in_sql;
}

 

if( (empty($real_url_part[1])) && (empty( $g_page_info['page'] )) ) $g_page_info['page'] = 1;
  
switch(TRUE)
{
	case in_array($g_page_info['action'], $special_page) :
	{
		$g_page_info['page_type'] = $g_page_info['action'];	
        break;
	}
	
	
	case (($g_page_info['action'] == '') || ($g_page_info['action'] == 'index.php') || is_numeric($g_page_info['action']) ) :
	{
		$g_page_info['page_type'] = 'home';
        break;
	}
	
	
    default :
    {
        $row = models_DB::get('SELECT id FROM ' . CATEGORY_TABLE . ' WHERE url=\'' . $g_page_info['action'] . '\'');
        if(!empty($row))
		{
			$g_page_info['page_type'] = 'category';
			$g_page_info['page_id'] = $row[0]['id'];
		}
        else
        {
            $row = models_DB::get('SELECT id FROM ' . TAG_TABLE . ' WHERE url=\'' . $g_page_info['action'] . '\'');
		 
			if(!empty($row))
			{
				$g_page_info['page_type'] = 'tag';
				$g_page_info['page_id'] = $row[0]['id'];
			}
			else
            {
                $row = models_DB::get('SELECT id FROM ' . POST_TABLE . ' WHERE url=\'' . $g_page_info['action'] . '\'');
		      
                if(!empty($row))
                {
                	$g_page_info['page_type'] = 'post';
                	$g_page_info['page_id'] = $row[0]['id'];
                	
                	
                }
                else
                {
                    $g_page_info['page_type'] = '404';
                }
                
            }
        }
    }
    
	 
}

//h($g_page_info);