<?php
	$current_url = get_current_url();
?>
<div class="col-xs-4 col-md-2 text-left" id="sidebar">

    <ul>
        <li>
            <a class="admin_home" href="<?php echo SITE_URL ?>">Visit Site</a>
        </li>
    </ul>
    
    <ul>
        <li>
            <a class="admin_home <?php if($current_url == SITE_URL.'/admin/') echo 'active' ?>" href="<?php echo SITE_URL.'/admin' ?>">Admin Home</a>
        </li>
    </ul>
    
    <ul>
        <li class="title">Posts</li>
        <ul class="sub">
            
            <?php 
                $obj_DB = new models_DB; 
                $post_type_ids = $obj_DB->get('SELECT id,title FROM post_type');
                foreach($post_type_ids as $v)
                {
                    
                    $this_url = SITE_URL . '/admin/index.php?action=all_posts&body=all_posts_body&post_type_id=' . $v['id']
                    ?>
                    
                    <li>
                        <a class="all_posts <?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">All <?php echo $v['title'] ?></a>
                    </li>
                    <?php $this_url = SITE_URL . '/admin/index.php?action=add_new_post&body=post_form&post_type_id='.$v['id']  ?>
                    <li>
                        <a  class="add_new_post post_type_id_<?php echo $v['id'] ?> <?php if($current_url == $this_url) echo 'active' ?>" href="?action=add_new_post&body=post_form&post_type_id=<?php echo $v['id'] ?>">New <?php echo $v['title'] ?></a>
                    </li>
                    <hr />
                    <?php
                }
            ?>
            
        </ul>
         
    </ul>

    <ul>
        <li class="title">Categories</li>
        <ul class="sub">
            <?php $this_url = SITE_URL . '/admin/index.php?action=all_categories&body=all_categories_body' ?>
            <li>
                <a class="all_categories <?php if($current_url == $this_url) echo 'active' ?>" href="?action=all_categories&body=all_categories_body">All categories</a>
            </li>
            
            <?php $this_url = SITE_URL . '/admin/index.php?action=add_new_category&body=category_form' ?>
            <li>
                <a class="add_new_category  <?php if($current_url == $this_url) echo 'active' ?>" href="?action=add_new_category&body=category_form">New category</a>
            </li>
        </ul>
         
    </ul>
    
    <ul>
        <li class="title">Post Type</li>
        <ul class="sub">
             <?php $this_url = SITE_URL . '/admin/index.php?action=all_post_type&body=all_post_type_body' ?>
            <li>
                <a class="all_post_type <?php if($current_url == $this_url) echo 'active' ?>" href="?action=all_post_type&body=all_post_type_body">All Post Type</a>
            </li>
            
            <?php $this_url = SITE_URL . '/admin/index.php?action=add_new_post_type&body=add_new_post_type_body' ?>
            <li>
                <a class="add_new_post_type <?php if($current_url == $this_url) echo 'active' ?>" href="?action=add_new_post_type&body=add_new_post_type_body">New Post Type</a>
            </li>
        </ul>
         
    </ul>
    
  
    <ul>
        <li class="title">Blocks</li>
        <ul class="sub">
            <?php $this_url = SITE_URL . '/admin/all_block_area' ?>
            <li>
                <a class="all_block_area <?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo SITE_URL  ?>/admin/all_block_area">All Block Area</a>
            </li>
            
            <?php $this_url = SITE_URL . '/admin/add_new_block_area' ?>
            <li>
                <a class="add_new_block_area <?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo SITE_URL  ?>add_new_block_area">New Block Area</a>
            </li>
        </ul>
         
    </ul>
</div>