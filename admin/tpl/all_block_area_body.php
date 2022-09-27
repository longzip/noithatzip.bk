<?php
	if(!defined('SECURE_CHECK')) die('Stop');
?>
<?php
$moment = array(
    'order'     => 'desc'
);
$obj_DB = new models_DB;
?>
<div id="notification" class="col-table bg-success col-xs-7 col-md-9 text-left"></div>
<div class="all fl col-xs-12 col-md-9">

    <header>
        
        <div class="stt  fl">STT</div>
        <div class="id  fl">ID</div>
        <div class="post_title fl">Title</div>
        <div class="image fl">Name</div>

        <div class="cat  fl">Description</div>
        <div class="action fl">Action</div>
        <span class="clear"></span>
    </header>
    
    <section class="body">

<?php

//$areas = models_DB->get('SELECT * FROM block_area');
foreach($obj_DB->get('SELECT * FROM ' . BLOCK_AREA_TABLE) as $k=>$v)
{
    $k++;
    ?>
    
    <div class="body-item" particular="<?php echo $v['id'] ?>">
        <div class="stt  fl"><?php echo $k; ?></div>
        <div class="id  fl"><?php echo $v['id'] ?></div>
        <div class="post_title fl"><?php echo $v['name'] ?></div>
        <div class="image fl"><?php echo $v['url'] ?></div>
        <div class="cat text-center fl"><?php echo $v['description'] ?></div>

         <div class="action fl">
            <a class="fl" href="<?php echo SITE_URL ?>/admin/edit_block_area/<?php echo $v['id'] ?>">Edit</a>
            
            <span class="delete_block_area delete fr">Delete</span> 
        </div>
        <span class="clear"></span>
    </div>    
    
    <?php
}

?>
    </section>
</div>