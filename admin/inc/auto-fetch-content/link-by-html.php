<?php
	if(isset($_POST['submit']))
    {
        
        //h($_POST);
        
        $list_links1 = str_get_html($_POST['links'], '<a>');
         $list_links2  = $list_links1->find('.video-info a');
         
         
         
         foreach($list_links2 as $k=>$link)
        {
            $list_links[] = $link->href;
        }
        
        //h($list_links);die();
        
        $list_links = array_reverse($list_links);
        
        $failed = array();
        $success  = array();
        
        foreach($list_links as $k=>$link)
        {
            
                $link = str_replace(' ', '', $link, $count); 
                
                $temp = fetch_content($link);
                if($temp == FALSE) 
                {
                    $failed[] = $link;
                }
                else $success[] = $temp;
            
            
            
        }
    
    
    
?>

<div id="statistic">
    <p class="title-font">Thống kê kết quả :</p>
    <div class="success">
        <p class="result-title">Thành công : <span class="num"><?php  echo count($success) ?></span> <span class="view-success">Xem chi tiết</span> </p>
        <div class="content" id="view-success">
            <?php 
                foreach($success as $v)
                {
                    ?>
                    <p><a href="<?php echo $v ?>"><?php echo $v  ?></a></p>
                    <?php
                }
            ?>
        </div>
    </div>
    
    
    
    <div class="failed">
        <p class="result-title">Đã tồn tại : <span class="num"><?php  echo count($failed) ?></span> <span class="view-failed">Xem chi tiết</span> </p>
        <div class="content" id="view-failed">
            <?php 
                foreach($failed as $v)
                {
                    $exist_post = models_DB::get('SELECT id FROM ' . POST_TABLE . ' WHERE fetch_url=\'' . $v .'\'');
                    $exist_post = $exist_post[0];
                    ?>
                    <p><a href="<?php echo $v ?>"><?php echo $v  ?></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  tại &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a target="_blank" href="<?php hcv_url('p', '', $exist_post['id']) ?>"><?php hcv_url('p', '', $exist_post['id']) ?></a></p>
                    <?php
                }
            ?>
        </div>
    </div>
</div>


<?php 
}
?>
<form action="" method="POST">
    <label class="title-font block bold">Danh sách link ( mỗi link trên 1 dòng )</label>
    <textarea class="textarea  main-content" name="links"><?php if(isset($_POST['links'])) echo $_POST['links'] ?></textarea>
    
    
    <p class="title-font">Cấu trúc trang nguồn</p>
    
    <div class="fetch-item">
    <label class="title-font">Base url</label>
    <input type="text" name="f_base" class="text" />
    <span class="clear"></span>
    </div>
    <span class="clear"></span>
    
    <div class="fetch-item">
    <label class="title-font">Tiêu đề</label>
    <input type="text" value=".video-title" name="f_title" class="text" />
    <span class="clear"></span>
    </div>
    <span class="clear"></span>
    
    <div class="fetch-item">
    <label class="title-font">Nội dung</label>
    <input type="text" name="f_content" class="text" />
    <span class="clear"></span>
    </div>
    <span class="clear"></span>
    
    <div class="fetch-item">
    <label class="title-font">Hình ảnh</label>
    <input type="text" name="f_image" class="text" />
    <span class="clear"></span>
    </div>
    <span class="clear"></span>
    
    <br /><br /><br />
    
    
    <p class="title-font">Tham số trang đích</p>
    <!-- <div class="new-thread-item box">
		<label class="block">Chuyên mục</label>
		<?php
			$sub_count = 0;
				
			function display_forum_checkbox($forum, $selected = array())
			{
				
				
				global $sub_count;
				?>
					<div class="forum">
						<div class="forum-detail">
							<label class="forum-label"><input name="forum[]" type="checkbox"   value="<?php echo $forum['id'] ?>" /><?php echo $forum['title'] ?></label>
							
							
						</div>
					
					 <?php 
						$sub_forums = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=' . $forum['id'] . ' ORDER BY stt ASC');
						if(!empty($sub_forums))
						{
							$sub_count++;
							?>
							<div class="sub-forum sub-forum-<?php echo $sub_count ?>">
							<?php
							foreach($sub_forums as $s_k=>$s_v)
							{
								display_forum_checkbox($s_v, $selected);
							}
							?>
							</div>
							<?php
						}
						else $sub_count = 0;
					   ?>
					   </div>
				
				<?php
			}
			$forums = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent=0');
			$sub_count = 0;
			foreach($forums as $forum)
			{
				
				?>
				<div class="forum-item">
					<?php display_forum_checkbox($forum) ?>
				</div>
				<?php
			}
		?>
		
		<span class="clear"></span>
	</div> -->
    
    <input type="submit" id="submit" value="Ok" name="submit" />
</form>