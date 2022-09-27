<?php
$moment = array(
    'order'     => 'desc'
);
$obj_DB = new models_DB;
$post_types = $obj_DB->get('SELECT * FROM ' . POST_TYPE_TABLE);
?>
<div id="notification" class="col-table bg-success col-xs-7 col-md-9 text-left"></div>
<div class="all fl col-xs-12 col-md-9">

    <header>
        
        <div class="stt  fl">STT</div>
        <div class="id  fl">ID</div>
        <div class="post_title fl">Title</div>


        
        <div class="action fl"  style="width: 25%;">Action</div>
        <span class="clear"></span>
    </header>
    
    <section class="body">

<?php
$k_terms = 0;
foreach($post_types as $post_type)
{
    $k_terms++;
    ?>
    
    <div class="body-item" post_type_id="<?php echo $post_type['id'] ?>">
        <div class="stt  fl"><?php echo $k_terms; ?></div>
        <div class="id  fl"><?php echo $post_type['id'] ?></div>
        <div class="post_title fl"><?php echo $post_type['name'] ?></div>


        <div class="action fl" style="width: 25%;">
            <a class="fl" href="<?php echo SITE_URL . '/admin/edit_post_type/' . $post_type['id'] ?>">Edit</a>
            <a class="fl" href="<?php echo SITE_URL . '/admin/manager_post_type_field/' . $post_type['id']; ?>" >Manager Fields</a>
            <span class="delete_post_type delete fr">Delete</span> 
        </div>
        <span class="clear"></span>
    </div>    
    
    <?php
}

?>
    </section>
</div>