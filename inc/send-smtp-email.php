<?php 
 $param = array(
    'content'       => urldecode($_GET['content']),
    'login_info'    => array('user_name'=>$_GET['user_name'], 'password'=>$_GET['password']),
    'to'            => $_GET['mailto'],
    'subject'       => urldecode($_GET['subject'])
);

send_smtp_mail( $param );