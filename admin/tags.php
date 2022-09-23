<?php
    if(!defined('SECURE_CHECK')) die('Invalid to include');
    
    if(!user_can('tags')) die();
    
    if(isset($_POST['submit']))
    { 
       
       
        
    }
	$g_page_content['title'] = 'All Tags';
     
	include 'header.php';
     
    function display_tag($tag)
    {
         
        global $sub_count;
        ?>
            <div class="category">
            
                <div class="category-detail border-left-hover">
                    <a class="category-title" href="<?php if(user_can('edit-tag')) echo SITE_URL, '/admin/?page_type=edit-tag&tag_id=', $tag['id']; else echo '#' ?>"><?php echo $tag['title'] ?></a>
                    <div class="action">
                        <?php hcv_link(hcv_url('t', $tag['url'], $tag['id'], FALSE), 'Xem');//echo SITE_URL, '/admin/edit-tag/', $tag['id'] ?>
                    
                        <?php 
                            if(user_can('edit-tag'))
                            {
                            ?>
    						<a class="edit" href="<?php echo SITE_URL, '/admin/?page_type=edit-tag&tag_id=', $tag['id'] ?>">Sửa</a>
                            <?php 
                            }
                        ?>
                        <?php 
                            if(user_can('delete-tag'))
                            {
                        ?>
                        <a class="delete-tag delete" category_id="<?php echo $tag['id'] ?>" href="<?php echo SITE_URL, '/admin/delete-tag/?id=' . $tag['id'] ?>">Xóa</a>
                        <?php 
                            }
                        ?>
                        </div>
                    <span class="stt">
                    <?php 
                         
                        
                        $param = array('field'=>' COUNT(id) AS total_post', 'tag'=>$tag['id']);
                        
                        $posts_count = get_posts($param);
                         
                        echo $posts_count[0]['total_post'] 
                    ?>
                    </span>
                </div>
            
             <?php 
                $sub_tags = models_DB::get('SELECT * FROM ' . TAG_TABLE . ' WHERE parent=' . $tag['id'] . ' ORDER BY stt ASC');
                if(!empty($sub_tags))
                {
                    $sub_count++;
                    ?>
                    <div class="sub-category sub-category-<?php echo $sub_count ?>">
                    <?php
                    foreach($sub_tags as $s_k=>$s_v)
                    {
                        display_tag($s_v);
                    }
                    ?>
                    </div>
                    <?php
                }
                
               ?>
               </div>
               <?php 
            ?>
        
        <?php
    }
    
?> 

<div id="content" class="container">
    <div class="admin-col1 fl v-col-lg-2 v-col-md-3 v-col-sm-3 v-col-xs-4 v-col-tx-4">
        <?php include 'sidebar.php'; ?>
    </div>
    <div class="admin-col2 fl v-col-lg-10 v-col-md-9 v-col-sm-9 v-col-xs-8 v-col-tx-8">
        <div id="main-content" class=" ">
            <div class="box">
            <?php $tags = models_DB::get('SELECT * FROM ' . TAG_TABLE . ' WHERE parent=0 ORDER BY title ASC '); ?>
            <h1 class="h1-title">Tags ( <?php echo count($tags) ?> )
                <div class="fr inline-block posts-action">
                     <a title="Thêm mới" class="posts-new-post  " href="<?php echo SITE_URL . '/admin/?page_type=new-tag' ?>"><i class="fa fa-plus"></i></a>
                </div>
            </h1>
            <?php show_form_success() ?>
            </div>
            
            <div class="box" id="tag">
                 <?php 
                    $tags = models_DB::get('SELECT * FROM ' . TAG_TABLE . ' WHERE parent=0 ORDER BY title ASC');
                    $sub_count = 0;
                    foreach($tags as $tag)
                    {
                        
                        ?>
                        <div class="category-item">
                            <?php display_tag($tag) ?>
                        </div>
                        <?php
                    }
                ?>
            </div>
           
           
        </div>
        
    </div>
     
        
    
    <span class="clear"></span>
</div>