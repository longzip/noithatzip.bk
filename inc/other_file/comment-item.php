<div style="margin-left:<?php echo $real_sub * 55 ?>px"class="comment-item post-item <?php if(defined('NEW_COMMENT')) echo ' new ' ?> sub-<?php echo $real_sub ?>" real_sub="<?php echo $real_sub ?>" id="comment-<?php echo $comment['id'] ?>">
		<p class="comment-author-image fl">
			<?php 
            
                      
                if(empty($comment_user['image'])) 
                {
                    $letter = str_split ($comment_user['user_name']);
                    ?>
                    <span class="comment-author-image-by-letter"><?php echo $letter[0] ?></span>
                    <?php    
                }
                else  
                {
                    ?>
                    <img src="<?php echo $comment_user['image'] ?>" />
                    <?php
                }
            ?>
			
			<span class="celar"></span>
		</p>
		<div class="fl comment-right">
			<p class="user-name">
				<span class="user-name-detail <?php echo $comment_user['permission'] ?>"><?php echo $comment_user['user_name'] ?></span>
				 <span class="time"> · <?php echo hcv_real_time($comment['time_create']) ?></span>
			</p>
			<div class="comment-content">
				<?php echo $comment['content']; ?>
			</div>
			<div class="comment-footer">
				 									
				<span title="Reply" class="fl core-reply reply pointer post-action-item guest-reply-to <?php if($g_user_id) echo 'reply-to' ?>" user_id="<?php echo $comment_user['id'] ?>" post_stt="<?php echo $comment['id'] ?>" post_id="<?php echo $post_id ?>">
					<i class="fa fa-reply reply"></i>&nbsp;Reply
				</span>
			</div>
			<span class="clear"></span>
		</div>
		<span class="clear"></span>

		<div class="user-action">
		<?php
		if(USER_PERMISSION == 'admin')
		{
			
			?>
			
			<span href="#" title="Xóa bài viết này" class="core-delete-comment fa fa-times fr pointer post-action-item delete-post" user_id="<?php echo $comment_user['id'] ?>" post_stt="<?php echo $comment['id'] ?>" post_id="<?php echo $post_id ?>">
			x
			</span> 
			<span id=""  class="fr fa fa-pencil user-edit"></span>
			
			  
			<?php
		}
		else
		{
			if(0)//($g_user_id == $comment['user_id']) && ($g_user_id)
			{
				?>
				<span href="#" title="Xóa bài viết này" class="core-delete-comment fa fa-times fr pointer post-action-item delete-post" user_id="<?php echo $comment_user['id'] ?>" post_stt="<?php echo $comment['id'] ?>" post_id="<?php echo $post_id ?>">
				x
				</span>  
				<span id=""  class=" fa fa-pencil fr user-edit"></span>
				
				<?php
					
			}
						
		}
		?>
		</div>
		</div> 