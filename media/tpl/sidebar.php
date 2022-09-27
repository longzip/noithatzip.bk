<section id="sidebar" class="row">
    <ul>
		<?php $this_link = SITE_URL . '/admin/?page_type=media-dir' ?>
		<li  class="fl <?php if($this_link == get_current_url()) echo 'active' ?>">
            <a href="<?php echo $this_link ?>">Thư mục</a>
        </li>
        
		<?php $this_link = SITE_URL . '/admin/?page_type=media-by-link' ?>
		<li  class="fl <?php if($this_link == get_current_url()) echo 'active' ?>">
            <a href="<?php echo $this_link ?>">Chèn bằng link</a>
        </li>
        
        <?php $this_link = SITE_URL . '/admin/?page_type=media-upload-history' ?>
		<li  class="fl <?php if($this_link == get_current_url()) echo 'active' ?>">
            <a href="<?php echo $this_link ?>">Tải lên gần đây</a>
        </li>
		
	 
         
    </ul>
</section>