<?php 

if(!defined('SECURE_CHECK')) die('Stop');

 
get_post_size();
if(isset($_GET['c'])) 
{
    $g_page_info['page_type'] = 'category';
    $g_page_info['page_id'] = $_GET['c'];  
}
else
{
    if(isset($_GET['t'])) 
    {
        $g_page_info['page_type'] = 'tag';
        $g_page_info['page_id'] = $_GET['t'];  
    }
    else
    {
        if(isset($_GET['p'])) 
        {
            $g_page_info['page_type'] = 'post';
            $g_page_info['page_id'] = $_GET['p'];  
        }
        else
        {
            $g_page_info['page_type'] = 'home';
        }
    }
}

if(isset($_GET['page'])) 
{
    $g_page_info['page'] = $_GET['page']; 
}
else $g_page_info['page'] = 1;

