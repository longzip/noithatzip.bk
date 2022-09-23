<?php

$global_sqli = new mysqli('localhost', 'root', 'congvuong', 'tool_chatbox');

include 'DB.php';

include 'emoticon.php';

//$temp = 'CREATE TABLE IF NOT EXISTS list(id INT(10) UNSIGNED AUTO_INCREMENT , content TEXT, user_id INT(10), time_create VARCHAR(255), PRIMARY KEY(id))';
//$global_sqli->query($temp);

$g_DB = new models_DB;

if($_POST['type'] == 'send_messenger')
{
    $all_emoticon = array_merge($g_advanced_emoticon, $g_basic_emoticon, $g_beautiful_emoticon, $g_cartoon_emoticon, $g_fun_emoticon, $g_other_emoticon);
    $messenger_content = $_POST['content'];
    foreach($all_emoticon as $k=>$v)
    {
        $replace = ' <img title="' . $v['name'] . '" class="emoticon-image" src="images/emoticon/' . $v['url'] . '" /> ';
        $messenger_content = str_replace('' . $k . '', $replace, $messenger_content);
    }
    
    
    
    $insert_content['content'] = $messenger_content;
    
    $insert_content['time_create']  = hcv_time(); 
    //array('content'=>$_POST['content'], 'time_create'=>time());

    $insert_id = models_DB::insert($insert_content,  'list');
    
    if($insert_id) echo 'Success'; else echo 'Failed';
}

if($_POST['type'] == 'load_messenger')
{
    
    $last_id = get_last_id();
    
    if($last_id != $_POST['last_id'])
    {
        $messenger = models_DB::get('SELECT * FROM list WHERE id='.$last_id);
    
        //foreach($messenger as $v=>$k)
        //{
        //    $return[] = array($v['time_create'], $v['content'], $v['id']);
        //}
        
        $return_display = "<div class='chat-item'>
                                <span class='name'>" . " Vường " . " : </span>
                                <span class='chat-content'>" . $messenger[0]['content'] . "</span>
                            </div>"; 
        
        echo json_encode(array('id'=>$messenger[0]['id'], 'return_display'=>$return_display));
    
    }
    else echo '0';
    
    
}

if($_POST['type'] == 'load_pre_messenger')
{
    
   
    $messenger = models_DB::get('SELECT * FROM list WHERE id<'.$_POST['first_id']. ' ORDER BY id DESC LIMIT ' . NUMBER_ITEM_TO_LOAD);
    if(!empty($messenger))
    {
        
        
        $messenger = array_reverse($messenger);
        $return_display = '<div id="chatbox-more-' . $_POST['more_id'] . '">';
        $id = $messenger[0]['id'];
        foreach($messenger as $k=>$v)
        {
            $return_display .= "<div class='chat-item'>
                                <span class='name'>" . " Vường " . " : </span>
                                <span class='chat-content'>" . $v['content'] . "</span>
                            </div>"; 
        } 
        
        $return_display .= '</div>';
        
        echo json_encode(array('id'=>$id, 'return_display'=>$return_display));
    }
    
}

if($_POST['type'] == 'load_emoticon')
{
    switch($_POST['type_emoticon'])
    {
        case 'basic' :
        {
            foreach($g_basic_emoticon as $k=>$v)
            {
                ?>
                <div class="emoticon-icon fl">
                    <img char="<?php echo htmlentities($k) ?>" title="<?php echo $v['name'] ?>" src="images/emoticon/<?php echo $v['url'] ?>" />
                </div>
                <?php
            }
        }
        break;
        
        case 'advanced' :
        {
            foreach($g_advanced_emoticon as $k=>$v)
            {
                ?>
                <div class="emoticon-icon fl">
                    <img char="<?php echo htmlentities($k) ?>" title="<?php echo $v['name'] ?>" src="images/emoticon/<?php echo $v['url'] ?>" />
                </div>
                <?php
            }
        }
        break;
        
        case 'fun' :
        {
            foreach($g_fun_emoticon as $k=>$v)
            {
                ?>
                <div class="emoticon-icon fl fun">
                    <img char="<?php echo htmlentities($k) ?>" title="<?php echo $v['name'] ?>" src="images/emoticon/<?php echo $v['url'] ?>" />
                </div>
                <?php
            }
        }
        break;
        
        case 'other' :
        {
            foreach($g_other_emoticon as $k=>$v)
            {
                ?>
                <div class="emoticon-icon fl other">
                    <img char="<?php echo htmlentities($k) ?>" title="<?php echo $v['name'] ?>" src="images/emoticon/<?php echo $v['url'] ?>" />
                </div>
                <?php
            }
        }
        break;
        
        case 'cartoon' :
        {
            foreach($g_cartoon_emoticon as $k=>$v)
            {
                ?>
                <div class="emoticon-icon fl cartoon">
                    <img char="<?php echo htmlentities($k) ?>" title="<?php echo $v['name'] ?>" src="images/emoticon/<?php echo $v['url'] ?>" />
                </div>
                <?php
            }
        }
        break;
        
        case 'beautiful' :
        {
            foreach($g_beautiful_emoticon as $k=>$v)
            {
                ?>
                <div class="emoticon-icon fl beautiful">
                    <img char="<?php echo htmlentities($k) ?>" title="<?php echo $v['name'] ?>" src="images/emoticon/<?php echo $v['url'] ?>" />
                </div>
                <?php
            }
        }
        break;
        
    }
    
    
}



?>