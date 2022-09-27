<?php
 

if(isset($_POST['type']) && $_POST['type']=='order')
{
    $order_content = $_POST;
    
     
    
    $form_info = get_form($_POST['form_id']);
    
    $insert_content = array(
            'the_type'          => 'order',
            'field_form'        => $_POST['form_id'],
            'order_content'     => json_encode($order_content),
            'time_create'       => hcv_time()
    );
    
    $insert_id = models_DB::insert($insert_content, FORM_TABLE);
    
    if($insert_id)
    { 
        echo $form_info['text_after_submit'];
    }
    
    $notification_content = array(
		'type'			=> 'order',
		'name'			=> $form_info['name'],
		'order_id'		=> $insert_id
     );
    $admin = models_DB::get('SELECT id FROM ' . USER_TABLE . ' WHERE permission=\'admin\'');
		 
    foreach($admin as $v_admin)
    {
		$param_noti = array(
			'user_id'		=> $v_admin['id'],
			'content'		=> json_encode($notification_content),
			'already_read'	=> 0,
			'time_create'	=> hcv_time()
		 );
		 insert_user_notification($param_noti);
	}
}
  