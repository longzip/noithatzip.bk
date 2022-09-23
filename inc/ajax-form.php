<?php
 
if(isset($_POST['type']) && $_POST['type']=='order')
{
    $order_content = $_POST;
     
    $form_info = get_form($_POST['form_id']);
    
    echo $form_info['other2']; 
    
    $insert_content = array(
            'the_type'          => 'order',
            'field_form'        => $_POST['form_id'],
            'order_content'     => json_encode($order_content),
            'time_create'       => hcv_time()
    );
    
    $insert_id = models_DB::insert($insert_content, FORM_TABLE);
    
    if($insert_id)
    { 
        ?>
        <div class="after-submit">
        <?php echo $form_info['text_after_submit']; ?>
        <div class="back-form"><i class="fa  fa-chevron-left "></i> Hoàn tác</div>
        </div>
        <?php
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
     
    
    // STATISTIC
    $a = '';
    $order_info = get_form($insert_id);
    $fields  = get_forms( array('field_form'=>$order_info['field_form'], 'the_type'=>'field', 'order'=> ' ORDER BY field_stt ASC ') );
    
    $a = $a . '<td style="border: 1px solid silver;padding: 5px 10px;">Đường dẫn đăng ký</td>';
    
    foreach($fields as $field)
    {
        $a = $a . '<td style="border: 1px solid silver;padding: 5px 10px;">' . $field['field_name'] . '</td>';
    }
    
    $b = '';
    $list_post = $order_info;		 
    $order_content = json_decode($list_post['order_content'], TRUE);
    
    
    $b = $b . '<td style="border: 1px solid silver;padding: 5px 10px;">' . $_POST['url'] . '</td>';
    
    foreach($fields as $field)
    {
        if(empty($order_content[$field['field_slug']])) continue;
        $b = $b . '<td style="border: 1px solid silver;padding: 5px 10px;">' . $order_content[$field['field_slug']] . '</td>';
    }
    $content = '<table style="border-collapse: collapse;width:100%">
                    <tr style="font-weight:bold">
                        ' . $a . '
                    </tr>
                    <tr>
                        ' . $b . '
                    </tr>
    
                </table>';    
    
 
    
    //Email
    $a = '';
    $order_info = get_form($insert_id);
    $fields  = get_forms( array('field_form'=>$order_info['field_form'], 'the_type'=>'field', 'order'=> ' ORDER BY field_stt ASC ') );
    
    $a = $a . '<td style="border: 1px solid silver;padding: 5px 10px;">Đường dẫn đăng ký</td>';
    foreach($fields as $field)
    {
        $a = $a . '<td style="border: 1px solid silver;padding: 5px 10px;">' . $field['field_name'] . '</td>';
    }
    
    $b = '';
    $list_post = $order_info;		 
    $order_content = json_decode($list_post['order_content'], TRUE);
    $b = $b . '<td style="border: 1px solid silver;padding: 5px 10px;">' . $_POST['url'] . '</td>';
    foreach($fields as $field)
    {
        if(empty($order_content[$field['field_slug']])) continue;
        $b = $b . '<td style="border: 1px solid silver;padding: 5px 10px;">' . $order_content[$field['field_slug']] . '</td>';
    }
    $content = '<table style="border-collapse: collapse;width:100%">
                    <tr style="font-weight:bold">
                        ' . $a . '
                    </tr>
                    <tr>
                        ' . $b . '
                    </tr>    
                </table>';
                
                
    
     
    $mail_tos =  explode(' ', $form_info['mail_to']);
    foreach($mail_tos as $mail_to)
    {
        
        
        
        $last_send_time = get_option('v-form-mail-token-time-' . pretty_string($mail_to));
        if(empty($last_send_time)) $last_send_time= 0;        
        if(hcv_time() - $last_send_time <= 5) continue;//die('Gửi mail quá nhanh')                                
        update_option('v-form-mail-token-time-' . pretty_string($mail_to), hcv_time());
        
        $param = array(
            'content'       => $content,
            'login_info'    => $mail_no_reply_info,
            'to'            => $mail_to,
            'subject'       => SITE_URL . ' : Form ' . $form_info['name'] . ' đã được gửi '
        );
        send_smtp_mail( $param );               
        
    }
    
    
    //ENd email
    
    //Auto Reply Email
    if(!empty($form_info['auto_reply_content']))
    {
        $content = $form_info['auto_reply_content'];
        $subject = $form_info['auto_reply_title'];
        
        foreach($fields as $field)
        {
            $subject = str_replace('@' . $field['field_slug'], $order_content[$field['field_slug']], $subject);
            $content = str_replace('@' . $field['field_slug'], $order_content[$field['field_slug']], $content);
        }
        foreach($fields as $field)
        {
            if(strpos('091117' . $order_content[$field['field_slug']], '@'))
            {
                
                $param = array(
                    'display_brand' => '[' . strtoupper( str_replace('http://', '', str_replace('https://', '', SITE_URL)) ) . ']',
                    'content'       => $content,
                    'login_info'    => $mail_no_reply_info,
                    'to'            => str_replace(' ', '', $order_content[$field['field_slug']]),
                    'subject'       => $subject
                );
                send_smtp_mail( $param );       
            }
        }
    }
     
} 