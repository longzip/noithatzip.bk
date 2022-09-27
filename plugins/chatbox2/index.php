<?php



//echo date("d/m/y - H:i:s a", hcv_time());

$global_sqli = new mysqli('localhost', 'root', 'congvuong', 'tool_chatbox');

include 'DB.php';

//$temp = 'CREATE TABLE IF NOT EXISTS list(id INT(10) UNSIGNED AUTO_INCREMENT , content TEXT, user_id INT(10), time_create VARCHAR(255), PRIMARY KEY(id))';
//$global_sqli->query($temp);

$g_DB = new models_DB;

$last_messenger = models_DB::get('SELECT * FROM list ORDER BY id DESC limit ' . NUMBER_ITEM_TO_LOAD);



$last_messenger = array_reverse($last_messenger); 

include 'emoticon.php';

//echo json_encode(array('time'=>'1212323', 'content'=>'messenger content', 'last_id'=>3));




?><!DOCTYPE html>
<html>
<head>

<title>Chat Box</title>

<meta charset="utf-8" />
<meta name="author" content="hcv" />
<meta name="generator" content="hcv" />

<meta property='og:locale' content='en_US'/>
<meta property='og:type' content='website'/>



<link rel="stylesheet" href="css/reset.css" type="text/css" />

<link rel="stylesheet" href="css/css.css" />




<script>
    var site_url = "<?php  echo 'http://localhost/Tools/chatbox' ?>";
    var last_id = "<?php echo get_last_id() ?>";
    var first_id = "<?php if(count($last_messenger) == NUMBER_ITEM_TO_LOAD) echo get_last_id() - NUMBER_ITEM_TO_LOAD + 1; else echo '0' ?>";
</script>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/js.js"></script>  
</head>
<body class="arial">

<div id="chatbox-1" class="chatbox">
    <div class="fl frame">
        <div class="content scroll">
            <?php 
                foreach($last_messenger as $k=>$v)
                {
                    ?>
                    <div class="chat-item">
                        <span class="name"><?php echo date('H-i-s', $v['time_create']) ?> : </span>
                        <span class="chat-content"><?php echo $v['content'] ?></span>
                    </div>
                    <?php
                }
            ?>
        </div>
        
        <div class="form">
            <form class="chat-form" method="POST">
                <span class="toggle-emoticon pointer"></span>
                <input class="input" value="" />
                <input type="submit" class="submit-messenger" value="Gửi" />
            </form>
        </div>
    </div>
    
    <div class="fr emoticon scroll">
        <span class="close-emoticon"></span>
        <ul class="emoticon-title-type">
            <li type="basic"  class="basic active">Cơ bản</li>
            <li type="advanced" class="advanced">Mở rộng</li>
            <li type="fun"  class="fun">Nghịch ngợm</li>
            <li style="width: 60px;" type="beautiful" class="beautiful">Dễ thương</li>
            
            <li type="cartoon"  class="cartoon">Hoạt hình</li>
            <li type="other"  class="other">Khác</li>
            <span class="clear"></span>
        </ul>
        <span class="clear"></span>
        <div class="emoticon-content">
        
        <?php 
            foreach($g_basic_emoticon as $k=>$v)
            {
                ?>
                <div class="emoticon-icon fl">
                    <img char="<?php echo htmlentities($k) ?>" title="<?php echo $v['name'] ?>" src="images/emoticon/<?php echo $v['url'] ?>" />
                </div>
                <?php
            }
        ?>
        </div>
        
    </div>
    <span class="clear"></span>
</div>


</body>




