<?php
    if(!defined('SECURE_CHECK')) die('Invalid to include');
    
	if((!is_numeric($_GET['id'])) || (!isset($_GET['id']))) die();
	
	
	$forum = get_forum($_GET['id']);
    
	
    if(isset($_POST['submit']))
    { 
		models_DB::delete(CATEGORY_TABLE, ' WHERE id='.$_GET['id']);
		header('Location:' . SITE_URL . '/admin/categories/');
    }
	$g_page_content['title'] = 'Delete Category';
    
    
	
?>

<?php
	include 'header.php';
?>

<div id="content" class="container">

    <?php include 'sidebar.php'; ?>
        
    <div id="main-content" class="fl col-10-6">
        <div class="box">
        
        <h1>Bạn có chắc chắn muốn xóa  " <?php  echo $forum['title'] ?> "</h1>
       
		<br /><br />
		
		<div>
			<p>Forum này đang có <b><?php echo $forum['thread_count'] ?></b> bài viết và <b><?php echo $forum['post_count'] ?></b> trả lời</p>
		</div>
	   
        </div>
        
        <form class="box" method="POST" action="">
            <input type="submit" class="btn btn-info" value="Có" name="submit" />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="<?php echo SITE_URL ?>/admin/forum" class="">Không</a>
        </form>
       
       
    </div>
    <span class="clear"></span>
</div>