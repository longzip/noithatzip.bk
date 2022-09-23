<?php

/**
 * Get Current Url
 */
function get_current_url()
{
    $result_url = 'http';
    if(isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS'])) $result_url = 'https';
    $result_url .= '://';
    $result_url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    return $result_url;
    
}
