<?php
	if(!defined('SECURE_CHECK')) die('Stop');
?>
<?php
$obj_query = new models_query();

$post_type_name = get_another_value_column('name', 'post_type', ' WHERE id=' .$_GET['post_type_id']);
//echo $post_type_name;
$temporary = array(
    'post_type_id'      => $_GET['post_type_id']
);

//h($a);
?>
<div id="notification" class="col-table bg-success col-xs-7 col-md-9 text-left"></div>
<input type="hidden" disabled="disabled" id="post_type_id" value="<?php echo $_GET['post_type_id'] ?>" />
<div class="all fl col-xs-12 col-md-9">
    <h1 class="page-title"><?php echo $global_current_row['page_title'] ?></h1>
    <header>
        
        <div class="stt  fl">STT</div>
        <div class="id  fl">ID</div>
        <div class="post_title fl">Title</div>
        <div class="suffix fl">Suffix</div>
        <div class="cat fl">Categories</div>
        
        <div class="action fl">Action</div>
        <span class="clear"></span>
        
    </header>
    
    <section class="body">

<?php
$all_posts = $obj_query->query_posts($temporary);
if(!empty($all_posts))
{
    foreach($all_posts as $k_posts=>$v_posts)
    {
        $k_posts++;
        $url_part = explode('-', $v_posts['url']);
        
        $url_suffix = explode(URL_SUFFIX_SEPARATE, $url_part[count($url_part)-1]);
    
        $table = $url_suffix[1];
        ?>
    
        <div class="body-item" particular="<?php echo $v_posts['id'] ?>" table="<?php echo $table; ?>">
            <div class="stt  fl"><?php echo $k_posts; ?></div>
            <div class="id  fl"><?php echo $v_posts['id'] ?></div>
            <div class="post_title fl"><a href="<?php echo $v_posts['url'] ?>" target="_blank"><?php echo $v_posts['title'] ?></a></div>
    
            <div class="suffix fl"><?php echo $url_part[count($url_part)-1] ?></div>
            <div class="cat fl">
                <?php
                    foreach(unserialize($v_posts['category']) as $category_item)
                    {
                        echo get_cat_name($category_item),'<br />';
                    } 
                    
                ?>
            </div>
            <div class="action fl">
                <a class="fl" href="?action=edit_post&post_type_id=<?php echo $_GET['post_type_id'] ?>&table=<?php echo $table  ?>&post_id=<?php echo $v_posts['id'] ?>&body=post_form">Edit</a>
                <a class="fl" href="<?php echo SITE_URL . '/rao-vat/' . $v_posts['url'] ?>">View</a> 
                <span class="delete_post delete fr">Delete</span> 
            </div>
            <span class="clear"></span>
        </div>
        
        <?php
    }    
}


?>
     </section>
</div>