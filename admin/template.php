<?php
    if(!defined('SECURE_CHECK')) die('Invalid to include');
    
    if(!user_can('template')) die();
    
	$g_page_content['title'] = 'Templates';
?>

<?php
    if(!defined('SECURE_CHECK')) die('Invalid to include');
    
    if(isset($_GET['active']))
    { 
        $fields = models_DB::get('SELECT * FROM ' . OPTION_TABLE);
        
        
        
        
        foreach($fields as $k => $v)
        {
            $update_content = array('value' => $_GET['active']);
            models_DB::update($update_content, OPTION_TABLE, ' WHERE name=\'template\'');
        }
        
        $g_form_success = 'Template Actived';
        
    }
	
?>

<?php
	include 'header.php';
?>

<style>
.giao-dien-item {
    padding: 0 10px;
    box-sizing: border-box;
    margin: 20px 0;
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
}

.giao-dien-item-inner {
    height: 365px;
    overflow: hidden;
    box-sizing: border-box;
    border: 1px solid #dadada;
    position: relative;
    box-shadow: 0 0 1px 1px #dedede;
        margin: 5px;
}
.giao-dien-item-img img {
    position: relative;
    width: 100%;
    top: 0;
    left: 0;
    transition: all 5s;
    -webkit-transition: all 5s;
    height: 100%;
}

.giao-dien-item-title {
    /* font-weight: bold; */
    text-align: center;
    margin: 20px 0;
    font-size: 17px;
    color: #000;
}

.giao-dien-item-action a {
    font-family: Roboto, arial;
    font-size: 12px;
    background: #0074a2;
    text-decoration: none;
}

.giao-dien-item-action a:hover {
    background: #064e6b;
}

span.fr.current {
    background: #b66706;
    padding: 3px 10px;
    font-size: 12px;
    color: #fff;
    font-family: Roboto, arial;
    border-radius: 5px;
}
</style>

<script>

$("body").on("mouseenter", ".giao-dien-item-img img", function(){
     var this_height = $(this).height();
     var parent_height = $(this).parent().parent().height();
     $(this).css("top", parent_height - this_height + "px"); 
});

$("body").on("mouseout", ".giao-dien-item-img img", function(){
      
     $(this).css("top", "0px"); 
});

</script>

<div id="content" class="container">

    <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
        <div id="main-content" class=" ">
       
       <div class="box">
            <h1>Kho giao diện</h1>
            <?php show_form_success() ?>
       </div>
       
       <div class="box">       
      <?php
        $current_tempate = get_option('template');
        $a = scandir(PATH_ROOT . '/tpl');
        foreach($a as $k=>$v)
        {
            if(($v!='.')&&($v!='..') && ($v != 'error_log') && ($v != 'index.php') )
            {
                if( (!is_numeric($v)) && ($v != TEMPLATE) ) continue;
                ?>
                
                <div id="" class=" giao-dien-item v-col-lg-4 v-col-md-6 v-col-sm-6 v-col-xs-6 v-col-tx-12 fl" >
                    <div class=" giao-dien-item-inner">
                        <div class="giao-dien-item-img">
                            <?php 
                                /*
                                $image = CDN_DOMAIN . '/tpl/' . $v . '/sc.png';
                                $size = getimagesize($image);
                                
                                $scale = $size[0] / $size[1];
                                
                                $image_thumb = cdn_timthumb_url($image, 400, 400 / $scale, FALSE );
                                
                                */
                                 
                            ?>
                            <!-- <img src="<?php //echo $image_thumb ?>" /> -->
                        </div>
                        
                        
                    </div>
                    <div class="giao-dien-item-title">
                        Mẫu web BĐS &nbsp; &nbsp;<?php echo 'Z - ', $v ?>
                    </div>
                    <div class="giao-dien-item-action">
                        <p class="text">
                            <a class="fl btn btn-success" target="_blank" href="http://zland.vn/tpl/techiq/xem-demo.php?id=<?php echo $v ?>">Xem demo</a>
                            <?php 
                                if($current_tempate == $v)
                                {
                                    ?>
                                    <span class="fr current">Đang sử dụng</span>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <a class="fr btn btn-success" href="?page_type=template&active=<?php echo $v ?>">Dùng mẫu này</a>
                                    <?php
                                }
                            ?>
                            
                        </p>
                    </div>
                </div>
                
                
                <?php                
            }
        }
      ?>
      <span class="clear"></span>
       </div>
        <form action="" method="POST">
            
        </form>
    </div>
    </div>
        
    
    <span class="clear"></span>
</div>