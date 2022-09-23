<?php
session_start();
 
define('SECURE_CHECK', TRUE);
 
if(isset($_POST['type']) && $_POST['type']=='clear_smarty_cache')
{
    clear_smarty_cache();
}